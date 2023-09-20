<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends BaseController
{
    public function index()
    {
        return view('layouts.main');
    }
}
