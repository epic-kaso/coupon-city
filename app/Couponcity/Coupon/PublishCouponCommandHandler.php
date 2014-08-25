<?php namespace Couponcity\Coupon;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class PublishCouponCommandHandler implements CommandHandler
{

    use DispatchableTrait;
    /**
     * Handle the command.
     *
     * @param object $command
     * @return mixed
     */
    public function handle($command)
    {
       $coupon = Coupon::publish($command);

        $this->dispatchEventsFor($coupon);

        return $coupon;
    }

}