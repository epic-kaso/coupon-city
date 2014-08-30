<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 8:37 AM
     */

    namespace Couponcity\Merchant;


    trait MerchantSession
    {


        public static function loginMerchant($user)
        {
            \Session::set('merchant_id', $user->id);

            return $user;
        }


        public static function getCurrentMerchant()
        {
            $merchant_id = \Session::get('merchant_id', NULL);
            if (is_null($merchant_id))
                return NULL;

            return Merchant::find($merchant_id);
        }

        public static function attemptLogin($email, $password)
        {
            $merchant = Merchant::where('email', $email)->first();

            if (is_null($merchant)) {
                return FALSE;
            }

            if (\Hash::check($password, $merchant->password)) {
                \Session::set('merchant_id', $merchant->id);

                return TRUE;
            } else {
                return FALSE;
            }

        }

        public static function checkLogin()
        {
            $merchant_id = \Session::get('merchant_id', NULL);
            if (is_null($merchant_id)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }

        public static function profileComplete()
        {
            $merchant_id = \Session::get('merchant_id', NULL);
            $merchant = Merchant::find($merchant_id);

            return $merchant->is_profile_complete ? TRUE : FALSE;
        }

        public static function logout()
        {
            \Session::set('merchant_id', NULL);

            return TRUE;
        }

    }