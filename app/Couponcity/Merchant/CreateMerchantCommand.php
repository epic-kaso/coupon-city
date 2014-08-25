<?php namespace Couponcity\Merchant;

class CreateMerchantCommand
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

    public $business_area;

    /**
     * @param string email
     * @param string password
     */
    public function __construct($email, $password, $password_confirmation, $business_area)
    {
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
        $this->business_area = $business_area;

    }

}