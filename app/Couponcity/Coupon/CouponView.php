<?php  namespace Couponcity\Coupon;

use Couponcity\Events\CouponViewed;
use Laracasts\Commander\Events\EventGenerator;

class CouponView extends \Eloquent
{
    use EventGenerator;
    use TimeSortTrait;

    protected $guarded = ['id'];
    protected $table = 'coupon_views';

    public static function logView($command)
    {
        $couponview = CouponView::create([
            'user_id'   => $command->user_id,
            'coupon_id' => $command->coupon_id,
            'view_date' => $command->view_date
        ]);

        $couponview->raise(new CouponViewed($couponview));

        return $couponview;

    }

    public function coupon()
    {
        return $this->belongsTo('Couponcity\Coupon\Coupon');
    }

    public static function totalViews($merchant_id)
    {
        $sales = static::whereHas('coupon', function ($query) use ($merchant_id) {
            $query->where('merchant_id', $merchant_id);
        })->count();

        return $sales;
    }


}