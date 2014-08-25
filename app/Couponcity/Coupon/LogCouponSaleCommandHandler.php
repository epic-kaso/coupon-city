<?php namespace Couponcity\Coupon;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class LogCouponSaleCommandHandler implements CommandHandler
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
        $coupon = \CouponSale::logSale($command);

        $this->dispatchEventsFor($coupon);

        return $coupon;
    }

}