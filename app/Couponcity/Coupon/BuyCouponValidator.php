<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/26/14
 * Time: 1:37 PM
 */

namespace Couponcity\Coupon;


use Couponcity\User\CreateUserException;

class BuyCouponValidator {

    public function __construct()
    {

    }

    private $rules = [
        'coupon_id'    => 'required|integer',
        'user_id' => 'required|integer'
    ];

    public function validate(BuyCouponCommand $command)
    {
        $validation = \Validator::make(
            [
                'coupon_id'    => $command->coupon_id,
                'user_id' => $command->user_id
            ], $this->rules);

        if ($validation->fails()) {
            throw new CreateUserException($validation->messages());
        }
    }
} 