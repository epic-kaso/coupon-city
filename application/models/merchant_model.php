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

    public function login_email($email, $password) {
        $user = $this
                ->with('coupons')
                ->get_by(array('email' => $email, 'password' => sha1($password)));
        if (!empty($user) && is_object($user)) {
            $this->_create_session($user);
            return $user;
        } else {
            return FALSE;
        }
    }

    public function encrypt_password($row) {
        if (array_key_exists('password', $row)) {
            $row['password'] = sha1($row['password']);
        }
        return $row;
    }

    public function is_profile_complete($user_id) {
        $user = $this->get_by($user_id);
        $is_complete = $user->is_profile_complete;
        return $is_complete === 1;
    }

    public function set_profile_complete($user_id, $value = 1) {
        return $this->update($user_id, array('is_profile_complete', $value));
    }

    public function add_coupon($merchant_id, $coupon_data_array) {
        if ($this->is_profile_complete($merchant_id)) {
            if (is_array($coupon_data_array)) {
                $coupon_data_array['merchant_id'] = array_key_exists('merchant_id', $coupon_data_array) ? $coupon_data_array['merchant_id'] : $merchant_id;
                $ci = & get_instance();
                $ci->load->model('coupon_model', 'coupon');
                return $ci->coupon->insert($coupon_data_array);
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    private function _create_session($user) {
        if (@property_exists($user, 'coupons')) {
            $coups = $user->coupons;
        } else {
            $coups = array();
        }
        $data = array(Merchant::USER_SESSION_VARIABLE => array('id' => $user->id,
                'timestamp' => time(),
                'email' => $user->email,
                'images' => array(),
                'coupons' => $coups),
            'logged_in' => true);
        $this->session->set_userdata($data);
    }

}
