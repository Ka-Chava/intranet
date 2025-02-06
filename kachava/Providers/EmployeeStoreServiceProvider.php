<?php

namespace KCA\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Shopify\Clients\Storefront;

class EmployeeStoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Storefront client initialization
        $this->app->singleton('shopify.storefront.client', function () {
            // Load the access token as per instructions above
            $storefrontAccessToken = getenv('SHOPIFY_STOREFRONT_ACCESS_TOKEN');

            // Shop from which we're fetching data
            $shop = getenv('SHOPIFY_DOMAIN');

            return new \Shopify\Clients\Storefront($shop, $storefrontAccessToken);
        });

        //Admin client initialization
        $this->app->singleton('shopify.admin.client', function () {
            // Load the access token as per instructions above
            $adminAccessToken = getenv('SHOPIFY_ADMIN_ACCESS_TOKEN');

            // Shop from which we're fetching data
            $shop = getenv('SHOPIFY_DOMAIN');
            return new \Shopify\Clients\Graphql($shop, $adminAccessToken);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
