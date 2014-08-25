<?php namespace Couponcity\User;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use User;

class CreateUserCommandHandler implements CommandHandler
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
        $user = User::signup($command);
        $this->dispatchEventsFor($user);

        return $user;
    }

}