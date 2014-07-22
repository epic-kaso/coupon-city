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
class Merchant_model extends MY_Model {

    public $protected_attributes = array('id');
    public $before_create = array('created_at', 'updated_at', 'encrypt_password');
    //public $belongs_to = array('merchant' => array('model' => 'merchant_model'));

    public $has_many = array(
        'merchant_image' => array('model' => 'merchant_image_model', 'primary_key' => 'merchant_id'),
        'merchant_information' => array('model' => 'merchant_information_model', 'primary_key' => 'merchant_id'),
        'coupons' => array('model' => 'coupon_model', 'primary_key' => 'merchant_id')
    );
    public $validate = array(
        array('field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email|is_unique[merchants.email]'),
        array('field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required')
    );

    public function encrypt_password($row) {
        $row['password'] = sha1($row['password']);
        return $row;
    }

}
