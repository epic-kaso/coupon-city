<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 11:38 PM
     */

    namespace Couponcity\Events;


    class CouponViewed
    {

        public $couponView;

        public function __construct($couponView)
        {
            $this->couponView = $couponView;
        }
    }