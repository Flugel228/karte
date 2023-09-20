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

Route::group(['namespace' => 'App\Http\Controllers\API'], function () {
    Route::group(['prefix' => 'shop'], function () {
        Route::group(['prefix' => 'products'], function () {
            Route::post('/', 'ShopController@index');
            Route::get('/recent', 'ShopController@recentProducts');
            Route::get('/{product}', 'ShopController@show');
        });
        Route::get('categories', 'ShopController@categories');
        Route::get('colors', 'ShopController@colors');
        Route::get('tags', 'ShopController@tags');
        Route::get('prices', 'ShopController@prices');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::post('/', 'UserController@store');
        Route::get('/genders', 'UserController@genders');
        Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
            Route::post('login', 'AuthController@login');
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::post('me', 'AuthController@me');
            Route::post('wishlist', 'AuthController@wishlist');
            Route::group(['prefix' => '/products'], function () {
                Route::group(['prefix' => '/likes'], function () {
                    Route::post('/', 'LikeController@store');
                });
                Route::group(['prefix' => '/comments'], function () {
                    Route::post('/', 'CommentController@store');
                });
            });
        });
    });


});


