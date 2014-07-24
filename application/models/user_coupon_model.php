<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of coupon_image_model
 *
 * @author kaso
 */
class User_coupon_model extends MY_Model {

    public $_table = 'user_coupons';
    public $protected_attributes = array('id');
    public $belongs_to = array('user' => array('model' => 'user_model'));

    //public $has_many = array('comments' => array('model' => 'model_comments'));
    //put your code here


    public function get_coupons_for($user_id) {
        $ci = & get_instance();
        $ci->load->model('coupon_model', 'coupon');
        $coupons = array();
        $coupon_ids = $this->get_many_by(array('user_id' => $user_id));

        foreach ($coupon_ids as $value) {
            $coupon = $ci->coupon->get($value->key);
            $coupon->user_coupon_code = $coupon_ids->user_coupon_code;
            $coupons[] = $coupon;
        }

        return $coupons;
    }

}
