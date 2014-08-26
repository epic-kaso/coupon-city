<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the Closure to execute when that URI is requested.
    |
    */

    Route::any('user/fb-login',
        array('as' => 'user-fb-login', 'uses' => 'UserController@fbLogin')
    );

    Route::controller('user', 'UserController');
    Route::controller('merchant', 'MerchantController');

    Route::controller('merchant-dashboard', 'MerchantDashboardController');
    Route::controller('forgot-password', 'RemindersController');
    Route::controller('coupon', 'CouponController');
    Route::controller('category', 'CouponListingController');

    Route::controller('/', 'HomeController');