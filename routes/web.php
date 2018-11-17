<?php

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

Route::view('/', 'customer.home');

Auth::routes();
Route::redirect('/logout', '/');

Route::get('/customer', 'Customer\IndexController@index')->name('index');
Route::get('/customer/home', 'Customer\HomeController@index')->name('home');
Route::get('/customer/product/detail/{prod_id}', 'Customer\ProductController@detail')->name('product_detail');
Route::get('/customer/user/profile', 'Customer\UserController@profile');
Route::post('/customer/user/update', 'Customer\UserController@update');

//Admin
Route::get('/admin', 'Admin\IndexController@index')->name('admin');
Route::resource('/admin/setting/user', 'Admin\UserController', ['as' => 'admin.setting']);