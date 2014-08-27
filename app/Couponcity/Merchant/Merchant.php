<?php namespace Couponcity\Merchant;

/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/23/14
 * Time: 8:47 PM
 */

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
        $response = static::find($id)->with(['coupons' => function ($query) {
                $query->with('sales', 'views', 'redemptions');
            }]);

        return $response;
    }

}