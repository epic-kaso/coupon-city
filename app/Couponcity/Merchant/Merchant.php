<?php namespace Couponcity\Merchant;

/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/23/14
 * Time: 8:47 PM
 */

use Carbon\Carbon;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Couponcity\Events\MerchantSignedUp;
use Couponcity\Merchant\MerchantSession;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;

class Merchant extends \Eloquent implements StaplerableInterface
{

    use PresentableTrait;
    use EloquentTrait, EventGenerator;
    use MerchantSession;

    protected $hidden = array('password', 'remember_token');

    protected $presenter = 'Couponcity\Merchant\MerchantPresenter';

    protected $fillable = ['logo', 'email', 'password', 'area'];

    public function __construct(array $attributes = array())
    {

        $this->hasAttachedFile('logo', [
            'styles' => [
                'medium' => '300x300',
                'thumb'  => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }


    public static function boot()
    {
        static::saving(function ($model) {
            $acceptable = [
                'business_name'     => '',
                'contact_name'      => '',
                'address_one'       => '',
                'address_two'       => '',
                'city'              => 'alpha|required_with:address_one,address_two',
                'state'             => 'alpha|required_with:address_one,address_two',
                'business_category' => 'integer',
                'mobile_number'     => 'digits:11',
                'short_description' => '',
                'website'           => '',
                'opening_hours'     => '',
                'bank_name'         => '',
                'account_type'      => '',
                'account_number'    => 'digits:10'
            ];

            $is_profile_complete = TRUE;

            foreach ($acceptable as $key => $v) {
                if (empty($model->attributes[$key])) {
                    $is_profile_complete = FALSE;
                    break;
                }
            }

            $model->attributes['is_profile_complete'] = $is_profile_complete;

            return TRUE;
        });

        static::bootStapler();
        parent::boot();

    }

    public static function signUp(CreateMerchantCommand $command)
    {
        $user = Merchant::create(
            ['email'    => $command->email,
             'password' => $command->password,
             'city'     => $command->business_area,
             'logo'     => STAPLER_NULL
            ]
        );
        $user->raise(new MerchantSignedUp($user));

        return $user;
    }




    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function coupons()
    {
        return $this->hasMany('Couponcity\Coupon\Coupon');
    }

    public static function totalCouponSales($id)
    {
        $response = static::where('id',$id)->with(['coupons' => function ($query) {
                $query->with('sales', 'views', 'redemptions');
            }])->first();

        return $response->coupons;
    }

    public static function totalCouponSalesToday($id){
        $response = static::totalCouponSales($id);

        $today = Carbon::today();
        $tomorrow = $today->tomorrow();

        $coupons = $response->filter(
            function ($entry) use ($today, $tomorrow) {
                return $entry->created_at >= $today && $entry->created_at < $tomorrow;
            });

        return [
            'sales_count'=> $coupons->count(),
            'sales_revenue'=> static::earnings_today($response),
            'view_count'=>static::views_today($response),
            'redemption_count'=>static::redemptions_today($response)
        ];
    }

    public static function totalCouponSalesMonth($id){
        $response = static::totalCouponSales($id);

        $today = Carbon::today();
        $monthStart = $today->startOfMonth()->toDateTimeString();
        $monthEnd = $today->endOfMonth()->toDateTimeString();

        $coupons = $response->filter(
            function ($entry) use ($monthStart, $monthEnd) {
                return $entry->created_at >= $monthStart && $entry->created_at <= $monthEnd;
            });

        return [
            'sales_count'=> $coupons->count(),
            'sales_revenue'=> static::earnings_month($response),
            'view_count'=>static::views_month($response),
            'redemption_count'=>static::redemptions_month($response)
        ];
    }

    public static function earnings_today($response)
    {

        $today = Carbon::today();
        $tomorrow = $today->tomorrow();

        $coupons = $response->filter(
            function ($entry) use ($today, $tomorrow) {
                return $entry->created_at >= $today && $entry->created_at < $tomorrow;
            });

        $params = $coupons->toArray();
        //dd($params);
        $sum = 0;
        foreach($params as $p){
            foreach($p['sales'] as $sale){
                $sum += $sale['sales_price'];
            }
        }

        return $sum;

    }

    public static function earnings_month($response)
    {
        $today = Carbon::today();
        $monthStart = $today->startOfMonth()->toDateTimeString();
        $monthEnd = $today->endOfMonth()->toDateTimeString();

        $coupons = $response->filter(
            function ($entry) use ($monthStart, $monthEnd) {
                return $entry->created_at >= $monthStart && $entry->created_at <= $monthEnd;
            });

        $params = $coupons->toArray();
        $sum = 0;
        //dd($params);
        foreach($params as $p){
            foreach($p['sales'] as $sale){
                $sum += $sale['sales_price'];
            }
        }

        return $sum;

    }

    private static function views_month($response)
    {
        $today = Carbon::today();
        $monthStart = $today->startOfMonth()->toDateTimeString();
        $monthEnd = $today->endOfMonth()->toDateTimeString();

        $coupons = $response->filter(
            function ($entry) use ($monthStart, $monthEnd) {
                return $entry->created_at >= $monthStart && $entry->created_at <= $monthEnd;
            });

        $params = $coupons->toArray();
        $sum = 0;
        foreach ($params as $p) {
            $sum += count($p['views']);
        }

        return $sum;
    }

    private static function views_today($response)
    {
        $today = Carbon::today();
        $tomorrow = $today->tomorrow();

        $coupons = $response->filter(
            function ($entry) use ($today, $tomorrow) {
                return $entry->created_at >= $today && $entry->created_at < $tomorrow;
            });

        $params = $coupons->toArray();
        $sum = 0;
        foreach ($params as $p) {
            $sum += count($p['views']);
        }

        return $sum;

    }

    private static function redemptions_today($response)
    {
        $today = Carbon::today();
        $tomorrow = $today->tomorrow();

        $coupons = $response->filter(
            function ($entry) use ($today, $tomorrow) {
                return $entry->created_at >= $today && $entry->created_at < $tomorrow;
            });

        $params = $coupons->toArray();
        $sum = 0;
        foreach ($params as $p) {
            $sum += count($p['redemptions']);
        }

        return $sum;
    }

    private static function redemptions_month($response)
    {
        $today = Carbon::today();
        $monthStart = $today->startOfMonth()->toDateTimeString();
        $monthEnd = $today->endOfMonth()->toDateTimeString();

        $coupons = $response->filter(
            function ($entry) use ($monthStart, $monthEnd) {
                return $entry->created_at >= $monthStart && $entry->created_at <= $monthEnd;
            });

        $params = $coupons->toArray();
        $sum = 0;
        foreach ($params as $p) {
            $sum += count($p['redemptions']);
        }

        return $sum;
    }
}