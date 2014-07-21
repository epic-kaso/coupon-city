<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of merchant_model
 *
 * @author kaso
 */
class User_information_model extends MY_Model {

    public $protected_attributes = array('id');
    public $_table = 'users_informations';
    public $belongs_to = array('user' => array('model' => 'user_model'));

    //public $has_many = array('comments' => array('model' => 'model_comments'));
}
