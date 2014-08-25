<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/23/14
     * Time: 8:42 PM
     */

    namespace Couponcity\Coupon;

    use Codesleeve\Stapler\ORM\EloquentTrait;
    use Codesleeve\Stapler\ORM\StaplerableInterface;
    use Couponcity\Events\CouponCreated;
    use Couponcity\Merchant\Merchant;
    use Laracasts\Commander\Events\EventGenerator;
    use Laracasts\Presenter\PresentableTrait;

    class Coupon extends \Eloquent implements StaplerableInterface
    {

        use PresentableTrait;
        use EloquentTrait, EventGenerator;
        use TimeSortTrait;

        protected $presenter = 'Couponcity\Coupon\CouponPresenter';

        // Add the 'avatar' attachment to the fillable array so that it's mass-assignable on this model.
        protected $guarded = ['id'];

        public function __construct(array $attributes = array())
        {
            $this->hasAttachedFile('image_one', [
                'styles' => [
                    'medium' => '300x300',
                    'thumb'  => '100x100'
                ]
            ]);

            $this->hasAttachedFile('image_two', [
                'styles' => [
                    'medium' => '300x300',
                    'thumb'  => '100x100'
                ]
            ]);

            $this->hasAttachedFile('image_three', [
                'styles' => [
                    'medium' => '300x300',
                    'thumb'  => '100x100'
                ]
            ]);

            $this->hasAttachedFile('image_four', [
                'styles' => [
                    'medium' => '300x300',
                    'thumb'  => '100x100'
                ]
            ]);

            $this->hasAttachedFile('image_five', [
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
                if (empty($model->attributes['coupon_code'])) {
                    $model->attributes['coupon_code'] = $model->createCouponCode();
                }
                if (empty($model->attributes['merchant_id'])) {
                    $model->attributes['merchant_id'] = Merchant::getCurrentMerchant()->id;
                }

                return TRUE;
            });

            static::bootStapler();
            parent::boot();

        }


        public static function publish($command)
        {
            $coupon = Coupon::create(get_object_vars($command));

            $coupon->raise(new CouponCreated($coupon));

            return $coupon;
        }

        public function setNameAttribute($name){
            $this->attributes['name'] = $name;
            $slug = strtolower(url_title($name));
            $similar = static::where('slug',$slug)->first();
            if(!is_null($similar)){
                $slug = increment_string($slug);
            }
            $this->attributes['slug'] = $slug;
        }

        public function createCouponCode()
        {
            $code = random_string('alnum', 10);
            $coupon = Coupon::where('coupon_code', $code)->first();
            if (!is_null($coupon)) {
                return $this->createCouponCode();
            }

            return $code;
        }

        public function views()
        {
            return $this->hasMany('Couponcity\Coupon\CouponView');
        }

        public function sales()
        {
            return $this->hasMany('Couponcity\Coupon\CouponSale');
        }

        public function redemptions()
        {
            return $this->hasMany('Couponcity\Coupon\CouponRedeem');
        }

        public function merchant()
        {
            return $this->belongsTo('Couponcity\Merchant\Merchant');
        }

        public function related($limit = 4)
        {
            $related = Coupon::where('category_id', $this->category_id)->where('id', '!=', $this->id)
                ->get()->shuffle()
                ->take($limit);

            return $related;
        }

        public function is_available(){
            $sales_count = CouponSale::where('coupon_id',$this->id)->count();

            if($sales_count < $this->attributes['quantity']){
                return true;
            }else{
                return false;
            }
        }

        public function users(){
            return $this->belongsToMany('User');
        }
    }