<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 10/8/2014
 * Time: 12:14 PM
 */

namespace Couponcity\User;


class AddressUnavailableException extends \Exception{

    public function __construct($message){
        parent::__construct($message);
    }
} 