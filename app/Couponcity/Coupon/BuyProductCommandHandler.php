<?php namespace Couponcity\Coupon;

use Aws\CloudFront\Exception\Exception;
use Couponcity\User\AddressUnavailableException;
use Couponcity\User\User;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class BuyProductCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * Handle the command.
     *
     * @param BuyCouponCommand $command
     * @throws AddressUnavailableException
     * @throws NotEnoughMoneyException
     * @return mixed
     */
    public function handle($command)
    {
        $user = User::findOrFail($command->user_id);


        $coupon = Coupon::findOrFail($command->coupon_id);

        if (!$this->is_transaction_capable($user, $coupon)) {
            throw new NotEnoughMoneyException('Wallet Balance is not sufficient for transaction.');
        }

        if(!$user->hasAddress()){
            throw new AddressUnavailableException("User Address Unavailable");
        }

        $product_purchase = $this->create_user_purchase($command);

        $this->debit_user_account($user, $coupon);

        $this->dispatchEventsFor($product_purchase);

        return $product_purchase;
    }


    private function  is_transaction_capable($user, $coupon)
    {
        if ($user->wallet_balance >= $coupon->present()->current_price) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function create_user_purchase($command)
    {
        throw new Exception('has not implemented create_user_purchase @ BuyProductCommandHandler');
    }

    private function debit_user_account($user, $coupon)
    {
        $coupon->decreaseQuantity();
        return $user->debitWallet($coupon->present()->current_price);

    }

}