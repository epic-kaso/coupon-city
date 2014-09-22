<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/26/14
     * Time: 12:50 PM
     */

    return [
        "listeners"   => [
            'Couponcity\EventListeners\EmailNotifier',
            'Couponcity\EventListeners\CouponPriceChangedListener'
        ],
        "admin_email" => 'gatekeeper@couponcity.com.ng',
        "coupon_image_style" => [
            'normal' =>'640x360',
            'medium' => '320x180',
            'thumb'  => '160x90'
        ]
    ];