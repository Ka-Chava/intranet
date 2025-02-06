<?php

namespace App\Repositories;


class ShopifyRepository {

    private \Shopify\Clients\Graphql $adminClient;
    private \Shopify\Clients\Storefront $storefrontClient;

    public function __construct(\Shopify\Clients\Graphql $adminClient, \Shopify\Clients\Storefront $storefrontClient) {
        $this->adminClient = $adminClient;
        $this->storefrontClient = $storefrontClient;
    }

    public function getProducts() {
        return $this->storefrontClient->query(data: <<<QUERY
        {
            products (first: 50) {
                edges {
                    node {
                        id
                        title
                    }
                }
            }
        }
    QUERY);
    }
}
