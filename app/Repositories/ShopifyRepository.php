<?php

namespace App\Repositories;


use App\Data\Address;
use App\Data\Employee;
use App\Data\Order;
use App\Data\Product;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Shopify\Exception\HttpRequestException;
use Shopify\Exception\MissingArgumentException;

class ShopifyRepository {

    protected \Shopify\Clients\Graphql $adminClient;
    protected \Shopify\Clients\Storefront $storefrontClient;

    public function __construct(\Shopify\Clients\Graphql $adminClient, \Shopify\Clients\Storefront $storefrontClient) {
        $this->adminClient = $adminClient;
        $this->storefrontClient = $storefrontClient;
    }

    /**
     * @return Collection
     */
    public function getLastOrders(Employee $customer) {
        $query = <<<QUERY
          query {
            orders(first: 10, sortKey: CREATED_AT, reverse: true, query: "customer_id:$customer->only_id AND tag:employee") {
              edges {
                order: node {
                  id
                  createdAt
                  closed
                  closedAt
                  tags
                }
              }
            }
          }
        QUERY;

        $output = $this->adminClient->query(
            ['query' => $query],
            [],
            ['X-Shopify-Access-Token', env('SHOPIFY_ADMIN_ACCESS_TOKEN')]
        );

        $response = $output->getBody()->getContents();
        $decoded = json_decode($response, true);
        $c = new Collection;

        if($decoded['data']['orders']) {
            foreach ($decoded['data']['orders']['edges'] as $order) {
                $order = new \App\Data\Order($order['order']);
                $c->add($order);
            }
        }

        return $c;
    }

    /**
     * @return void
     */
    public function getNextOrderDate() {

    }


    public function getCustomer(): ?Employee
    {
        $user = Auth::user();

        $date = new DateTime();
        $date->setDate((int)$date->format('Y'), (int)$date->format('m'), 1);
        $date->setTime(0, 0, 0, 0);
        $formatted = $date->format('Y-m-d H:i:s');

        $query = <<<QUERY
          query {
            customers(first: 1, query: "email:$user->email") {
              edges {
                customer: node {
                  id
                  email
                  firstName
                  lastName
                  tags
                  addresses(first: 10) {
                    id
                    address1
                    address2
                    city
                    company
                    country
                    firstName
                    lastName
                    phone
                    province
                    zip
                    name
                    provinceCode
                    formatted
                    formattedArea
                    timeZone
                  }
                  orders(first: 1, sortKey: CREATED_AT, reverse: true, query: "(tag:employee) AND (created_at:>$formatted)") {
                    nodes {
                      id
                    }
                  }
                }
              }
            }
          }
        QUERY;

        $output = $this->adminClient->query(
            ['query' => $query],
            [],
            ['X-Shopify-Access-Token', env('SHOPIFY_ADMIN_ACCESS_TOKEN')]
        );

        $response = $output->getBody()->getContents();
        $decoded = json_decode($response, true);

        if (!$decoded['data']['customers']) {
            return null;
        }

        return new Employee($decoded['data']['customers']['edges'][0]['customer']);
    }

    /**
     * @return Collection
     * @throws \Shopify\Exception\HttpRequestException
     * @throws \Shopify\Exception\MissingArgumentException
     */
    public function getProducts() {
        $output = $this->storefrontClient->query(data: <<<QUERY
        {
            products (first: 50, query: "product_type:Shakes AND tag:for_intranet") {
                edges {
                    node {
                        id
                        title
                        totalInventory
                        featuredImage {
                            altText
                            url
                        }
                        variants(first: 1) {
                            nodes {
                                id
                            }
                        }
                    }
                }
            }
        }
    QUERY);

        $response = $output->getBody()->getContents();
        $decoded = json_decode($response, true);

        $c = new Collection;
        foreach ($decoded['data']['products']['edges'] as $node) {
            $p = $node['node'];
            $p['variant'] = $p['variants']['nodes'][0];
            $m = new Product($p);
            $c->add($m);
        }

        return $c;
    }

    /**
     * @throws MissingArgumentException
     * @throws HttpRequestException
     * @throws \Exception
     */
    public function createAddress(array $addressData, string $customerGid, ?bool $setAsDefault = false): Address
    {
        $query = <<<GRAPHQL
          mutation customerAddressCreate(\$address: MailingAddressInput!, \$customerId: ID!, \$setAsDefault: Boolean) {
            customerAddressCreate(address: \$address, customerId: \$customerId, setAsDefault: \$setAsDefault) {
              address {
                id
                address1
                address2
                city
                company
                country
                firstName
                lastName
                phone
                province
                zip
                name
                provinceCode
                formatted
                formattedArea
                timeZone
                validationResultSummary
              }
              userErrors {
                field
                message
              }
            }
          }
          GRAPHQL;

        $variables = [
            'customerId' => $customerGid,
            'address' => $addressData,
            'setAsDefault' => $setAsDefault,
        ];

        $response = $this->adminClient->query(data: ['query' => $query, 'variables' => $variables]);

        $data = $response->getDecodedBody();

        $result = $this->handleMutation('customerAddressCreate', $data['data']);

        return new Address($result['address']);
    }

    public function processOrder($payload)
    {
        $order = [
            'input' => [
                'email' => $payload['email'],
                'note' => 'Draft order created by Employee Store',
                'tags' => ['employee'],
                'taxExempt' => true,
                'shippingLine' => [
                    'title' => 'Free Shipping (4-6 Business Days)',
                    'price' => 0,
                ],
                'shippingAddress' => $payload['address'],
                'billingAddress' => $payload['address'],
                'appliedDiscount' => [
                    'description' => 'Ordered from Employee Store.',
                    'value' => 100,
                    'valueType' => 'PERCENTAGE',
                    'title' => 'Employee Order',
                ],
                'lineItems' => $payload['items'],
                'visibleToCustomer' => false,
            ],
        ];

        $query = <<<GRAPHQL
          mutation draftOrderCreate(\$input: DraftOrderInput!) {
            draftOrderCreate(input: \$input) {
              draftOrder {
                id
              }
            }
          }
          GRAPHQL;

        $response = $this->adminClient->query(data: ['query' => $query, 'variables' => $order]);
        $data = $response->getDecodedBody();
        $result = $this->handleMutation('draftOrderCreate', $data['data']);

        $draftOrderId = $result['draftOrder']['id'];

        $processOrderMutation = <<<GRAPHQL
          mutation draftOrderComplete(\$id: ID!) {
            draftOrderComplete(id: \$id) {
              draftOrder {
                id
                order {
                  id
                  createdAt
                  closed
                  closedAt
                  tags
                }
              }
            }
          }
          GRAPHQL;

        $draftOrderCreateResponse = $this->adminClient->query(data: ['query' => $processOrderMutation, 'variables' => ['id' => $draftOrderId]]);
        $draftOrderData = $draftOrderCreateResponse->getDecodedBody();
        $result = $this->handleMutation('draftOrderComplete', $draftOrderData['data']);

        return new Order($result['draftOrder']['order']);
    }

    /**
     * @throws \Exception
     */
    protected function handleMutation(string $mutationName, array $result): array
    {
        $mutation = $result[$mutationName] ?? null;

        if (!$mutation) {
            throw new \Exception("Missing mutation result: {$mutationName}");
        }

        if (!empty($mutation['userErrors'])) {
            throw new \Exception($mutation['userErrors'][0]['message']);
        }

        return $mutation;
    }
}
