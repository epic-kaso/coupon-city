<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/15/14
 * Time: 8:03 AM
 */

namespace lib;
use Facebook\FacebookRedirectLoginHelper;

class MyFacebookRedirectLoginHelper extends FacebookRedirectLoginHelper {

    protected $sessionPrefix = 'FACEBOOK_SESSION_login';

    public function storeState($state)
    {
        \Log::info('Set State in session:' . $state);

        \Session::set($this->sessionPrefix, $state);

        $param = \Session::get($this->sessionPrefix, NULL);

        \Log::info('Read back state from session:' . $param);
    }

    public function loadState()
    {
        $param = \Session::get($this->sessionPrefix, NULL);
        $this->state = $param;

        return $this->state;
    }


    /**
     * Check if a redirect has a valid state.
     *
     * @return bool
     */
    protected function isValidRedirect()
    {
        //return true;
        $param = \Session::get($this->sessionPrefix, NULL);
        \Log::info('Read back state from session for loadstate:' . $param);
        $state = \Input::get('state', NULL);

        return $this->getCode() != NULL && $state == $param;
    }

    /**
     * Return the code.
     *
     * @return string|null
     */
    protected function getCode()
    {
        return \Input::get('code', NULL);
    }
} 