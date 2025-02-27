<?php

namespace App\Http\Controllers;

use App\Repositories\ShopifyRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class StoreController extends BaseController
{

    protected ShopifyRepository $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = app('shopify.repository');
        $seconds = now()->addHours(24);

        $key = 'customers_' . Auth::user()->id;
        $cached_customer = cache()->remember($key, $seconds, function() {
            return $this->repository->getCustomer();
        });

        $recent_orders = $this->repository->getLasOrders($cached_customer);

        //globally shared for all components
        View::share('customer', $cached_customer);
        View::share('recent_order', $recent_orders->first());
    }

    /**
     * This method loads up the view to display the employee store
     * @return void
     */
    public function viewStore() {

        cache()->flush();

        $seconds = now()->addHours(24);
        $cached_products = cache()->remember('users', $seconds, function () {
            return $this->repository->getProducts();
        });

        $product_limit = 2;

        return view('store', [
            'products' => $cached_products,
            'product_limit' => $product_limit
            ]
        );
    }

    public function processOrder() {

    }

}
