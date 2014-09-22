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
            'normal' =>[
            'dimensions' => '640x360',
                'convert_options' => ['jpeg_quality' => 70]
            ],
            'medium' => [
                'dimensions' => '320x180',
                'convert_options' => ['jpeg_quality' => 60]
            ],
            'thumb' =>[
                'dimensions' => '160x90',
                'convert_options' => ['jpeg_quality' => 50]
            ]
        ]
    ];