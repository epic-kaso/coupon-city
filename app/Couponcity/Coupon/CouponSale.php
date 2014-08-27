<?php

    namespace Couponcity\Coupon;

    use Couponcity\Events\CouponSold;
    use Laracasts\Commander\Events\EventGenerator;

    class CouponSale extends \Eloquent
    {
        use EventGenerator;
        use TimeSortTrait;

        protected $guarded = ['id'];

        protected $table = "coupon_sales";

        public static function logSale($command)
        {

            $couponsale = CouponSale::create([
                'user_id'          => $command->user_id,
                'coupon_id'        => $command->coupon_id,
                'sales_price'      => $command->sales_price,
                'sales_commission' => $command->sales_commission,
                'sales_date'       => $command->sales_date
            ]);

            $couponsale->raise(new CouponSold($couponsale));

            return $couponsale;

        }

        public function coupon()
        {
            return $this->belongsTo('Couponcity\Coupon\Coupon');
        }

        public static function totalSales($merchant_id)
        {
            $sales = static::whereHas('coupon', function ($query) use ($merchant_id) {
                $query->where('merchant_id', $merchant_id);
            })->get();

            return [
                'count' => $sales->count(),
                'sales' => $sales->sum('sales_price'),
                'average'=>$sales->avg('sales_price')
            ];
        }
    }