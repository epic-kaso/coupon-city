<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/23/14
     * Time: 9:25 PM
     */

    namespace Couponcity\Coupon;


    use Laracasts\Commander\Events\DispatchableTrait;

    class RedeemCoupon
    {

        use DispatchableTrait;

        public function redeem($code){

            $response =  CouponUser::redeemCoupon($code);

            $this->dispatchEventsFor($response);

            return $response;
        }

    }