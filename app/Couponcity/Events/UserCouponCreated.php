<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/26/14
     * Time: 1:29 PM
     */

    namespace Couponcity\Events;


    use Couponcity\Coupon\CouponUser;

    class UserCouponCreated
    {

        public $user_coupon;

        public function __construct(CouponUser $couponUser)
        {
            $this->user_coupon = $couponUser;
        }
    }