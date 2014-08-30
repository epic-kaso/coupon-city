<?php

    namespace Couponcity\Coupon;

    use Couponcity\Events\CouponRedeemed;
    use Laracasts\Commander\Events\EventGenerator;

    class CouponRedeem extends \Eloquent
    {
        use EventGenerator;
        use TimeSortTrait;

        protected $guarded = ['id'];

        protected $table = "coupon_redemptions";

        public static function logRedemption($command)
        {

            $couponsale = CouponRedeem::create([
                'user_id'             => $command->user_id,
                'coupon_id'           => $command->coupon_id,
                'redemption_price'    => $command->redemption_price,
                'redemption_discount' => $command->redemption_discount,
                'redemption_date'     => $command->redemption_date
            ]);

            $couponsale->raise(new CouponRedeemed($couponsale));

            return $couponsale;

        }
    }