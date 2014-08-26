<?php namespace Couponcity\Coupon;

    use Couponcity\Events\CouponRedeemed;
    use Couponcity\Events\UserCouponCreated;
    use Laracasts\Commander\Events\EventGenerator;

    class CouponUser extends \Eloquent {
        use EventGenerator;

	protected $fillable = ['coupon_id','user_id'];

    public static function boot(){
        static::creating(function($model){
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

        $coupon = static::where('user_coupon_code', $code)->first();
        if (!is_null($coupon)) {
            return static::generateUserCouponCode();
        }

        return $code;
    }

    public static  function grabCoupon($coupon_id,$user_id){
        $existing = CouponUser::where('coupon_id',$coupon_id)->where('user_id',$user_id)->first();
        if(empty($existing)){
            $coupon_user = CouponUser::create(['coupon_id'=>$coupon_id,'user_id'=>$user_id]);

            $coupon_user->raise(new UserCouponCreated($coupon_user));

            return $coupon_user;
        }else{
            throw new UserOwnsCouponException('you already own this coupon!');
        }
    }

    public static function redeemCoupon($coupon_code){
        $coupon = CouponUser::where('user_coupon_code',$coupon_code)->first();

        if(is_null($coupon)){
            throw new InvalidCouponCodeException("Couponcode is invalid");
        }

        $coupon->has_redeemed = true;

        $coupon->save();

        $coupon->raise(new CouponRedeemed($coupon));

        return $coupon;
    }

}