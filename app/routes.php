<?php

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