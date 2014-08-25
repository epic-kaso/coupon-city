<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 8:29 AM
     */

    namespace Couponcity\Events;


    class MerchantSignedUp
    {
        public $merchant;

        public function __construct(\Merchant $merchant)
        {
            $this->merchant = $merchant;
        }
    }