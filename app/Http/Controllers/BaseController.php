<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{

    public function __construct()
    {
        \View::share('user', \Auth::user());
    }
}
