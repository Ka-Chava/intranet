<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Shopify\Context as ShopifyContext;

class ShopifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        Blade::component('dashboard', \App\View\Components\DashboardLayout::class);

        ShopifyContext::initialize(
            apiKey: getenv('SHOPIFY_ADMIN_API_KEY'),
            apiSecretKey: getenv('SHOPIFY_ADMIN_API_SECRET'),
            scopes: getenv('SHOPIFY_SCOPES'),
            hostName: getenv('SHOPIFY_DOMAIN'),
            sessionStorage: new \Shopify\Auth\FileSessionStorage('/tmp/php_sessions'),
            apiVersion: '2025-01',
            isEmbeddedApp: false,
            isPrivateApp: true,
        );

        $app =& $this->app;

        $this->app->singleton('shopify.repository', function() use ($app) {
            $storefront = $app->make('shopify.storefront.client');
            $admin = $app->make('shopify.admin.client');
            return new \App\Repositories\ShopifyRepository($admin, $storefront);
        });

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
