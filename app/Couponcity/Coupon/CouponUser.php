<?php

    use Couponcity\Events\UserCouponCreated;
    use Laracasts\Commander\Events\EventGenerator;

    class CouponUser extends \Eloquent {
        use EventGenerator;

	protected $fillable = ['coupon_id','user_id'];

    public static function boot(){
        static::creating(function(static $model){
           $model->attributes['user_coupon_code'] = static::generateUserCouponCode();
           return true;
        });
    }

    protected $table = "coupon_user";

    public function user(){
        return $this->belongsTo('Couponcity\User\User');
    }

    public function coupon(){
        return $this->belongsTo('Couponcity\Coupon\Coupon');
    }

    public static function generateUserCouponCode(){

        $code = random_string('alnum',8);

        $coupon = static::where('coupon_code', $code)->first();
        if (!is_null($coupon)) {
            return static::generateUserCouponCode();
        }

        return $code;
    }

    public static  function grabCoupon($coupon_id,$user_id){
        $coupon_user = CouponUser::create(['coupon_id'=>$coupon_id,'user_id'=>$user_id]);

        $coupon_user->raise(new UserCouponCreated($coupon_user));

        return $coupon_user;
    }

}