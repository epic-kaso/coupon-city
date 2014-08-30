<?php namespace Couponcity\User;

class CreateUserCommand
{

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    public $password_confirmation;

    /**
     * @param string email
     * @param string password
     */
    public function __construct($email, $password, $password_confirmation)
    {
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;

    }

}