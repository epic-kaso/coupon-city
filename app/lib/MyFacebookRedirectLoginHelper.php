<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/15/14
     * Time: 8:03 AM
     */

    use Facebook\FacebookRedirectLoginHelper;

    class MyFacebookRedirectLoginHelper extends FacebookRedirectLoginHelper
    {

        protected $sessionPrefix = 'FBRLH_';

        public function storeState($state)
        {
            Session::set($this->sessionPrefix . 'login', $state);
        }

        public function loadState()
        {
            $param = Session::get($this->sessionPrefix . 'login', NULL);
            if (!is_null($param)) {
                $this->state = $param;

                return $this->state;
            }

            return NULL;
        }
    }