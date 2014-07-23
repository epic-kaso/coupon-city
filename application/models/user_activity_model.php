<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of transaction_model
 *
 * @author kaso
 */
class User_activity_model extends MY_Model {

    public $_table = 'user_activities';
    public $protected_attributes = array('id');
    public $belongs_to = array('user' => array('model' => 'user_model'));

    //public $has_many = array('comments' => array('model' => 'model_comments'));
}
