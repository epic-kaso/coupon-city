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


    public function get_coupons_for($user_id, $cat = 'all') {
        $ci = & get_instance();
        $ci->load->model('coupon_model', 'coupon');
        $coupons = array();
        $coupon_ids = $this->get_many_by(array('user_id' => $user_id));

        foreach ($coupon_ids as $value) {
            if ($cat == 'all') {
                $coupon = $ci->coupon->get($value->key);
            } else {
                $coupon = $ci->coupon->get_by(array('id' => $value->key, 'category_id' => $cat));
            }
            $coupon->user_coupon_code = $coupon_ids->user_coupon_code;
            $coupons[] = $coupon;
        }

        return $coupons;
    }

    public function get_coupon($user_id, $coupon_id) {
        $ci = & get_instance();
        $ci->load->model('coupon_model', 'coupon');
        $coupon_id = $this->get_by(array('user_id' => $user_id, 'coupon_id' => $coupon_id));
        if (!$coupon_id) {
            return FALSE;
        }
        $coupon = $ci->coupon->get($coupon_id->coupon_id);
        return $coupon;
    }

}
