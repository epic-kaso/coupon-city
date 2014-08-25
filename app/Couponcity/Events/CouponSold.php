<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 11:41 PM
     */

    namespace Couponcity\Events;


    class CouponSold
    {

        public $couponSold;

        public function __construct($coupon)
        {
            $this->couponSold = $coupon;
        }
    }