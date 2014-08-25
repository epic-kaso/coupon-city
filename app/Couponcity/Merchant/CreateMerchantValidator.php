<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 8:25 AM
     */

    namespace Couponcity\Merchant;


    use Couponcity\User\CreateUserException;

    class CreateMerchantValidator
    {

        public function __construct()
        {

        }

        private $rules = [
            'email'    => 'required|email|unique:merchants',
            'password' => 'required|min:5|confirmed',
            'area'     => 'required'
        ];

        public function validate(CreateMerchantCommand $command)
        {
            $validation = \Validator::make(
                [
                    'email'                 => $command->email,
                    'password'              => $command->password,
                    'password_confirmation' => $command->password_confirmation,
                    'area'                  => $command->business_area
                ], $this->rules);

            if ($validation->fails()) {
                throw new CreateUserException($validation->messages());
            }
        }


    }