<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/23/14
     * Time: 11:05 PM
     */

    namespace Couponcity\Events;


    use User;

    class UserSignedUp
    {

        public $user;

        public function __construct(User $user)
        {
            $this->user = $user;
        }
    }