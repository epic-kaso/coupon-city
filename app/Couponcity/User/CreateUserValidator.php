<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/23/14
     * Time: 10:48 PM
     */

    namespace Couponcity\User;


    class CreateUserValidator
    {

        public function __construct()
        {

        }

        private $rules = [
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ];

        public function validate(CreateUserCommand $command)
        {
            $validation = \Validator::make(
                [
                    'email'                 => $command->email,
                    'password'              => $command->password,
                    'password_confirmation' => $command->password_confirmation
                ], $this->rules);

            if ($validation->fails()) {
                throw new CreateUserException($validation->messages());
            }
        }
    }