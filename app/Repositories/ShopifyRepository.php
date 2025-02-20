<?php

namespace App\Repositories;


use App\Models\Employee;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ShopifyRepository {

    protected \Shopify\Clients\Graphql $adminClient;
    protected \Shopify\Clients\Storefront $storefrontClient;

    public function __construct(\Shopify\Clients\Graphql $adminClient, \Shopify\Clients\Storefront $storefrontClient) {
        $this->adminClient = $adminClient;
        $this->storefrontClient = $storefrontClient;
    }


    public function getCustomer() {
        $user = Auth::user();
        $query = <<<QUERY
          query {
            customers(first: 20, query: "email:$user->email") {
              edges {
                customer: node {
                  id
                  email
                  firstName
                  lastName
                  tags
                }
              }
            }
          }
        QUERY;

        $output = $this->adminClient->query(['query' => $query], [], ['X-Shopify-Access-Token', env('SHOPIFY_ADMIN_ACCESS_TOKEN')]);

        $response = $output->getBody()->getContents();
        $decoded = json_decode($response, true);
        if($decoded['data']['customers']) {
            return new Employee($decoded['data']['customers']['edges'][0]['customer']);
        }
        else {
            return null;
        }
    }

    /**
     * @return \Shopify\Clients\HttpResponse
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
            $m = new Product($p);
            $c->add($m);
        }

        return $c;

    }
}
