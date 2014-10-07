<?php namespace Couponcity\Coupon;

use Auth;
use Carbon\Carbon;

class LogCouponSaleCommand
{

    const SALES_TYPE_PRODUCT_PURCHASE = 'product_purchase';
    const SALES_TYPE_PRODUCT_RESERVATION = 'product_reservation';


    public $user_id;
    public $coupon_id;
    public $sales_price;
    public $sales_commission;
    public $sales_date;
    private $sales_type;

    /**
     * @param $coupon
     * @param $sales_type
     */
    public function __construct($coupon,$sales_type)
    {
        $this->user_id = is_null(Auth::id()) ? 'guest' : Auth::id();
        $this->coupon_id = $coupon->id;
        $this->sales_price = $coupon->present()->current_price;
        $this->sales_discount = $coupon->present()->current_discount;
        $this->sales_commission = $coupon->present()->get_sales_commission();
        $this->sales_date = Carbon::now();
        $this->sales_type = $sales_type;
    }

}