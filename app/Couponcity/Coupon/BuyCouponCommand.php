<?php namespace Couponcity\Coupon;

class BuyCouponCommand
{

    public $coupon_id;
    public $user_id;

    /**
     */
    public function __construct($coupon_id, $user_id)
    {
        $this->coupon_id = $coupon_id;
        $this->user_id = $user_id;
    }

}