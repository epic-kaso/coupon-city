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
class User_model extends MY_Model {

    public $protected_attributes = array('id');
    public $before_create = array('created_at', 'updated_at', 'encrypt_password');
    //public $belongs_to = array('merchant' => array('model' => 'merchant_model'));
    public $has_many = array(
        'transactions' => array('model' => 'transaction_model'),
        'user_information' => array('model' => 'user_information_model'),
        'user_coupons' => array('model' => 'user_coupon_model')
    );
    //public $belongs_to = array('user' => array('model' => 'user_model'));
    //public $has_many = array('comments' => array('model' => 'model_comments'));

    public $validate = array(
        array('field' => 'email',
            'label' => 'email',
            'rules' => 'required|valid_email|is_unique[merchants.email]'),
        array('field' => 'password',
            'label' => 'password',
            'rules' => 'required')
    );

    public function encrypt_password($row) {
        $row['password'] = sha1($row['password']);
        return $row;
    }

}
