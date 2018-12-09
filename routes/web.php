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

Route::redirect('/logout', '/');

// Customer routes
Route::namespace('Customer')->group(function() {
    Route::namespace('Auth')->group(function() {
        // Authentication Routes
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.post');
        Route::post('logout', 'LoginController@logout')->name('logout');

        // Registration Routes
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register')->name('register.post');

        // Password Reset Routes
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset.post');
    });

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/product/detail/{prod_id}', 'ProductController@detail')->name('product_detail');

    // Authorization required routes
    Route::middleware('auth')->group(function() {
        Route::get('/user/profile', 'UserController@profile')->name('profile');
        Route::post('/user/update', 'UserController@update')->name('profile.update');

        // Payment
        Route::get('/payment', 'PaymentController@getPayment')->name('payment.get_payment');
        Route::post('/payment/pay', 'PaymentController@pay')->name('payment.pay');

        //Invoice
        Route::get('/invoices', 'InvoiceController@index')->name('invoice.index');
        Route::get('/invoice/{id}', 'InvoiceController@show')->name('invoice.show');
        Route::get('/invoice/c/{id}', 'InvoiceController@showAndClearCart')->name('invoice.show_n_clear_cart');
        Route::get('/invoice/cancel/{id}', 'InvoiceController@cancel')->name('invoice.cancel');
        Route::post('/invoice/update/{id}', 'InvoiceController@update')->name('invoice.edit');
    });
});


//Admin routes
Route::group(['prefix' => 'admin', 'as'=>'admin.', 'namespace' => 'Admin'], function () {
    Route::namespace('Auth')->group(function() {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.post');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });

    Route::middleware('admin')->group(function() {
        Route::get('/', 'IndexController@index')->name('home');
        Route::resource('/setting/user', 'UserController', ['as' => 'setting']);
        Route::resource('/setting/product', 'ProductController', ['as' => 'setting']);
        Route::resource('/setting/invoice', 'InvoiceController', ['as' => 'setting']);
        Route::get('/setting/transaction/multiple_update','TransactionController@multiple_update')->name('transactions_multiple_update');
        Route::resource('/setting/transaction', 'TransactionController', ['as' => 'setting'])->only([
            'destroy','edit','update','show'
        ]);

    });
});

