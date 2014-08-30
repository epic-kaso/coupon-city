<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/29/14
 * Time: 12:22 PM
 */

namespace Couponcity\EventListeners;


use Couponcity\Coupon\UserCouponRefundHandler;
use Laracasts\Commander\Events\EventListener;

class CouponPriceChangedListener extends EventListener {

    private $userCouponRefundHandler;

    public function __construct(UserCouponRefundHandler $userCouponRefundHandler){
        $this->userCouponRefundHandler = $userCouponRefundHandler;
    }
    public function whenCouponPriceChanged($event){
        $this->userCouponRefundHandler->refundUsersOf($event->coupon_id,$event->current_price);
    }
} 