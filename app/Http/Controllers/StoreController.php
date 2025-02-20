<?php

namespace App\Http\Controllers;

use App\Repositories\ShopifyRepository;
use Illuminate\Support\Facades\Auth;

class StoreController extends BaseController
{

    protected ShopifyRepository $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = app('shopify.repository');
    }

    /**
     * This method loads up the view to display the employee store
     * @return void
     */
    public function viewStore() {
        //dd(json_decode($this->repository->getProducts()->getBody()->getContents(), true));

        cache()->flush();

        $seconds = now()->addHours(24);
        $cached_products = cache()->remember('users', $seconds, function () {
            return $this->repository->getProducts();
        });

        $key = 'customers_' . Auth::user()->id;
        $cached_customer = cache()->remember($key, $seconds, function() {
            return $this->repository->getCustomer();
        });

        return view('store', ['products' => $cached_products, 'customer' => $cached_customer]);
    }

    public function processOrder() {

    }

}
