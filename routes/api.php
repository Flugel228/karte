<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\API',], function () {
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::resource('users', 'UserController', [
            'only' => [
                'store',
                'update',
                'destroy',
            ],
        ]);
    });
});
