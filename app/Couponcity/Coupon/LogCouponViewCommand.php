<?php namespace Couponcity\Coupon;

use Carbon\Carbon;

class LogCouponViewCommand
{

    public $user_id;
    public $coupon_id;
    public $view_date;

    public function __construct($coupon_id, $user_id = 'guest')
    {
        $this->user_id = $user_id;
        $this->coupon_id = $coupon_id;
        $this->view_date = Carbon::now();
    }

}