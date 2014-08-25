<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 11:46 PM
     */

    namespace Couponcity\Events;


    class CouponRedeemed
    {

        public $couponRedeemed;

        public function __construct($coupon)
        {
            $this->couponRedeemed = $coupon;
        }

    }