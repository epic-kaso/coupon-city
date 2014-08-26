<?php namespace Couponcity\Coupon;

use CouponUser;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class BuyCouponCommandHandler implements CommandHandler {

    use DispatchableTrait;
    /**
     * Handle the command.
     *
     * @param BuyCouponCommand $command
     * @return mixed
     */
    public function handle($command)
    {
        $coupon_user = CouponUser::grabCoupon($command->coupon_id,$command->user_id);

        $this->dispatchEventsFor($coupon_user);

        return $coupon_user;
    }

}