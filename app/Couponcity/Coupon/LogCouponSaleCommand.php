<?php namespace Couponcity\Coupon;

use Carbon\Carbon;

class LogCouponSaleCommand
{

    public $user_id;
    public $coupon_id;
    public $sales_price;
    public $sales_commission;
    public $sales_date;

    /**
     */
    public function __construct($user_id, $coupon)
    {
        $this->user_id = $user_id;
        $this->coupon_id = $coupon->id;
        $this->sales_price = $coupon->present()->current_price;
        $this->sales_discount = $coupon->present()->current_discount;
        $this->sales_date = Carbon::now();
    }

}