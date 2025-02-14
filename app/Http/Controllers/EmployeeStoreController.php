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
        return view('employee-store');
    }

    public function processOrder() {

    }

}
