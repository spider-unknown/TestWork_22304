<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['uses' => 'Admin\PageController@home'])->middleware('auth');
Route::get('/home', ['uses' => 'Admin\PageController@home', 'as' => 'admin.index'])->middleware('auth');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::group(['namespace' => 'Auth',], function () {

        Route::get('/login', ['as' => 'admin.login', 'uses' => 'LoginController@showLoginForm']);
        Route::post('/login', ['as' => 'admin.login.post', 'uses' => 'LoginController@login']);
        Route::get('/register', ['as' => 'admin.register', 'uses' => 'RegisterController@showRegistrationForm']);
        Route::post('/register', ['as' => 'admin.register.post', 'uses' => 'RegisterController@create']);

        Route::post('logout', ['as' => 'logout', 'uses' => 'LoginController@logout'])->middleware('auth');
    });
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/products', ['uses' => 'ProductController@index', 'as' => 'admin.product.index']);
    Route::get('/product/create', ['uses' => 'ProductController@create', 'as' => 'admin.product.create']);
    Route::get('/product/edit/{id}', ['uses' => 'ProductController@edit', 'as' => 'admin.product.edit']);
    Route::post('/product/update', ['uses' => 'ProductController@storeUpdate', 'as' => 'admin.product.update']);
    Route::post('/product/delete/{id}', ['uses' => 'ProductController@delete', 'as' => 'admin.product.delete']);
});

