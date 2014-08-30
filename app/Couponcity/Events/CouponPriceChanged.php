<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/29/14
 * Time: 12:19 PM
 */

namespace Couponcity\Events;


class CouponPriceChanged {

        public $coupon_id;
        public $current_price;

        public function __construct($coupon_id,$currentPrice){
            $this->coupon_id = $coupon_id;
            $this->current_price = $currentPrice;

        }
}