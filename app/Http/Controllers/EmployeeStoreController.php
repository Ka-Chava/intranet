<?php

namespace App\Http\Controllers;

use App\Repositories\ShopifyRepository;

class EmployeeStoreController extends Controller
{

    protected ShopifyRepository $repository;

    public function __construct()
    {
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

        return view('employee-store', ['products' => $cached_products]);
    }

    public function processOrder() {

    }

}
