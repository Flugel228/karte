<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\View\View;

class HomeController extends BaseController
{

    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('admin.home');
    }
}
