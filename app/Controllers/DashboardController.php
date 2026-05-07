<?php

namespace App\Controllers;

use App\Models\UserModele;

class DashboardController extends BaseController
{

        public function __construct()
    {}

    public function index(): string
    {
        return view('dashboard/index');
    }

}