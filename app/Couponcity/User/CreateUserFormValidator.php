<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 7:57 PM
     */

    namespace Couponcity\User;


    use Laracasts\Validation\FormValidator;

    class CreateUserFormValidator extends FormValidator
    {
        protected $rules = [
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ];
    }