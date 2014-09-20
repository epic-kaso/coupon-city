<?php namespace Couponcity\Merchant;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CreateMerchantCommandHandler implements CommandHandler
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
        $user = Merchant::signUp($command);
        $this->dispatchEventsFor($user);

        return $user;
    }

}