<?php namespace Couponcity\Coupon;

use Couponcity\User\User;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class BuyCouponCommandHandler implements CommandHandler
{

    use DispatchableTrait;

    /**
     * Handle the command.
     *
     * @param BuyCouponCommand $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = User::findOrFail($command->user_id);
        $coupon = Coupon::findOrFail($command->coupon_id);

        if (!$this->is_transaction_capable($user, $coupon)) {
            throw new NotEnoughMoneyException('Wallet Balance is not sufficient for transaction.');
        }

        $coupon_user = $this->create_user_coupon($command);

        $this->debit_user_account($user, $coupon);

        $this->dispatchEventsFor($coupon_user);

        return $coupon_user;
    }


    private function  is_transaction_capable($user, $coupon)
    {


        if ($user->wallet_balance >= $coupon->present()->current_price) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function create_user_coupon($command)
    {
        return CouponUser::grabCoupon($command->coupon_id, $command->user_id);
    }

    private function debit_user_account($user, $coupon)
    {
        $coupon->decreaseQuantity();
        return $user->debitWallet($coupon->present()->current_price);

    }
}