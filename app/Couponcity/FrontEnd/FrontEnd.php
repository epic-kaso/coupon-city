<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/25/14
     * Time: 1:06 AM
     */

    namespace Couponcity\FrontEnd;


    use CouponCategory;
    use Couponcity\Coupon\Coupon;

    class FrontEnd
    {


        public function getLandingPageCouponSnippets()
        {
            $category = CouponCategory::take(3)->with(['coupons' => function ($query) {
                    $query->with('merchant')->take(3);
                }])->get();

            return $category;
        }

        public function getFeaturedDeals()
        {
//            $deals = FeaturedCoupon::with(['coupon'])->take(3)->get();
//
//            if (empty($deals)) {
//                $deals = Coupon::take(3)->get();
//            }

            $deals = Coupon::take(3)->get();

            return $deals;
        }
    }