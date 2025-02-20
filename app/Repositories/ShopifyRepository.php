<?php

namespace App\Repositories;


use App\Models\Product;
use Illuminate\Support\Collection;

class ShopifyRepository {

    private \Shopify\Clients\Graphql $adminClient;
    private \Shopify\Clients\Storefront $storefrontClient;

    public function __construct(\Shopify\Clients\Graphql $adminClient, \Shopify\Clients\Storefront $storefrontClient) {
        $this->adminClient = $adminClient;
        $this->storefrontClient = $storefrontClient;
    }

    /**
     * Checks if an employee already placed their monthly order
     * @return void
     */
    public function checkIfOrderWasPlaced() {

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
