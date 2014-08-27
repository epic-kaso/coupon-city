<?php namespace Couponcity\User;

/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/23/14
 * Time: 9:55 PM
 */

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{

    public function display_name(){
        if(empty($this->first_name)){
            $username = explode('@',$this->email);
            return ucfirst($username[0]);
        }else{
            return ucfirst($this->first_name);
        }
    }
}