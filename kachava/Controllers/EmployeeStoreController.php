<?php

namespace KCA\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Shopify\Clients\Storefront as ShopifyStorefront;

class EmployeeStoreController extends Controller
{

    protected ShopifyStorefront $storefrontClient;

    public function __construct()
    {
        $this->storefrontClient = app('shopify.storefront.client');
    }

    /**
     * This method loads up the view to display the employee store
     * @return void
     */
    public function viewStore() {
        dd(1);
    }

    public function processOrder() {

    }

}
