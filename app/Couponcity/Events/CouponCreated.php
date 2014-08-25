<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/24/14
 * Time: 8:53 PM
 */

namespace Couponcity\Events;


class CouponCreated {

    public $coupon;
    public function __construct($coupon){
        $this->coupon = $coupon;
    }
} 