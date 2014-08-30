<?php namespace Couponcity\Coupon;

use Carbon\Carbon;

class LogCouponRedemptionCommand
{

    public $user_id;
    public $coupon_id;
    public $redemption_price;
    public $redemption_discount;
    public $redemption_date;

    public function __construct($coupon, $user_id)
    {
        $this->user_id = $user_id;
        $this->coupon_id = $coupon->id;
        $this->redemption_price = $coupon->present()->current_price;
        $this->redemption_discount = $coupon->present()->current_discount;
        $this->redemption_date = Carbon::now();
    }

}