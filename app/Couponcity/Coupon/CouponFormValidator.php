<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 7:45 PM
     */

    namespace Couponcity\Coupon;


    use Laracasts\Validation\FormValidator;

    class CouponFormValidator extends FormValidator
    {

        protected $rules = [
            "name"                          => 'required',
            "tag_line"                      => 'required',
            "summary"                       => 'required',
            "description"                   => 'required',
            "old_price"                     => 'required',
            "new_price"                     => 'required',
            "discount"                      => 'required',
            "location"                      => 'required',
            "category_id"                   => 'required|integer',
            "start_date"                    => 'required',
            "end_date"                      => 'required',
            "quantity"                      => 'required|integer',
            "is_advanced_pricing"           => '',
            "advanced_price_one_price"      => 'required_if:is_advanced_pricing,1',
            "advanced_price_one_quantity"   => 'required_if:is_advanced_pricing,1',
            "advanced_price_one_discount"   => 'required_if:is_advanced_pricing,1',
            "advanced_price_two_price"      => '',
            "advanced_price_two_quantity"   => '',
            "advanced_price_two_discount"   => '',
            "advanced_price_three_price"    => '',
            "advanced_price_three_quantity" => '',
            "advanced_price_three_discount" => ''
        ];
    }