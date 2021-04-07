<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::group(['namespace' => 'Api', 'middleware' => ['cors']], function () {

    /*
    |--------------------------------------------------------------------------
    | Open Routes
    |--------------------------------------------------------------------------
    */

 //   Route::post('users/login', 'UserController@login');

    /*
    |--------------------------------------------------------------------------
    | Protected Routes, Authorization Required
    |--------------------------------------------------------------------------
    */

//     Route::group(['middleware' => ['auth']], function () {

//         Route::post('users/logout', 'UserController@logout');
//         Route::get('product', 'ProductController@getProductList');

//     });
// });
Route::namespace('Api')->group(function(){
    //Users
    Route::post('user', 'UserController@store')->name('user.store');
    Route::post('login', 'UserController@login')->name('user.login');

    //Category
    Route::get('category', 'CategoryController@search')->name('category.search');
    Route::post('category', 'CategoryController@store')->name('category.store');
    Route::get('category/{id}', 'CategoryController@show')->name('category.show');
    Route::put('category/{id}', 'CategoryController@update')->name('category.update');

    //Supplier
    Route::get('supplier', 'SupplierController@search')->name('supplier.search');
    Route::post('supplier', 'SupplierController@store')->name('supplier.store');
    Route::get('supplier/{id}', 'SupplierController@show')->name('supplier.show');
    Route::put('supplier/{id}', 'SupplierController@update')->name('supplier.update');

    //Product
    Route::get('product', 'ProductController@search')->name('product.search');
    Route::post('product', 'ProductController@store')->name('product.store');
    Route::get('product/{id}', 'ProductController@show')->name('product.show');
    Route::put('product/{id}', 'ProductController@update')->name('product.update');
    Route::delete('product/{id}', 'ProductController@destroy')->name('product.destroy');
});