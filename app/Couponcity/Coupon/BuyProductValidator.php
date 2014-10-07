<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 10/7/2014
 * Time: 8:13 PM
 */

namespace Couponcity\Coupon;


use Couponcity\User\CreateUserException;

class BuyProductValidator {
    public function __construct()
    {

    }

    private $rules = [
        'coupon_id' => 'required|integer',
        'user_id'   => 'required|integer'
    ];

    public function validate(BuyProductCommand $command)
    {
        $validation = \Validator::make(
            [
                'coupon_id' => $command->coupon_id,
                'user_id'   => $command->user_id
            ], $this->rules);

        if ($validation->fails()) {
            throw new CreateUserException($validation->messages());
        }
    }
} 