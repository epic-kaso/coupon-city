<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 7:47 PM
     */

    namespace Couponcity\Merchant;


    use Laracasts\Validation\FormValidator;

    class CreateMerchantFormValidator extends FormValidator
    {

        protected $rules = [
            'email'    => 'required|email|unique:merchants',
            'password' => 'required|min:5|confirmed',
            'business_area'     => 'required'
        ];
    }