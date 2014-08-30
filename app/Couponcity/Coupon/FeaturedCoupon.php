<?php namespace Couponcity\Coupon;

class FeaturedCoupon extends \Eloquent
{
    protected $fillable = [];

    protected $table = "featured_coupons";

    public function coupon()
    {
        return $this->belongsTo('Couponcity\Coupon\Coupon');
    }
}