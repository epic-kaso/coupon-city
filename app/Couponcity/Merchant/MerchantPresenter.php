<?php namespace Couponcity\Merchant;
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/23/14
     * Time: 8:47 PM
     */


    use Laracasts\Presenter\Presenter;

    class MerchantPresenter extends Presenter
    {

        public function status()
        {
            if ($this->is_profile_complete) {
                return '<span style="margin-top:32px;" class="left trans-state verified-trans">Complete</span>';
            } else {
                return '<span style="margin-top:32px;" class="left trans-state pending-trans">Incomplete:- ' . $this->is_profile_complete . '</span>';
            }
        }

        public function address()
        {
            return "<p>{$this->address_one},</p>" .
            "<p>{$this->address_two},{$this->city},</p>" .
            "<p>{$this->state}.</p>";
        }

        public function category()
        {
            $category = $this->business_category;

            return "Food and Drinks";
        }
    }