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
    public $has_many = array(
        'activities' => array('model' => 'user_activity_model', 'primary_key' => 'user_id'),
        'coupons' => array('model' => 'user_coupon_model', 'primary_key' => 'user_id'),
        'wallet' => array('model' => 'wallet_model', 'primary_key' => 'user_id')
    );
    public $validate = array(
        array('field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email|is_unique[users.email]'),
        array('field' => 'password',
            'label' => 'password',
            'rules' => 'trim')
    );

    public function encrypt_password($row) {
        if (array_key_exists('password', $row)) {
            $row['password'] = sha1($row['password']);
        }
        return $row;
    }

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

    public function is_unique_email($email) {
        $db = DB('default');
        $query = $db->limit(1)->get_where($this->_table, array('email' => $email));

        $db->close();
        if ($query->num_rows() !== 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function is_fb_oauth_enabled($email) {
        $db = DB('default');
        $query = $db->limit(1)->get_where($this->_table, array('email' => $email, 'oauth_enabled' => 1));

        $db->close();
        if ($query->num_rows() !== 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function enable_fb_oauth($email, $data) {
        $user = $this->get_by(array('email' => $email));
        if (!$user) {
            return FALSE;
        } else {
            $this->update($user->id, $data);
            $user = $this->get_by(array('email' => $email));
            if (!$user) {
                return $user;
            } else {
                $this->_create_session($user);
                return $user;
            }
        }
    }

    public function create_fb($data) {
        $id = $this->insert($data);
        return $id;
    }

    public function login_fb($email, $fb_id) {
        $user = $this->get_by(array('email' => $email, 'fb_oauth_id' => $fb_id));
        if (!$user) {
            return $user;
        } else {
            $this->_create_session($user);
            return $user;
        }
    }

    public function is_profile_complete($user_id) {
        $user = $this->get_by($user_id);
        $is_complete = $user->is_profile_complete;
        return $is_complete === 1;
    }

    public function set_profile_complete($user_id, $value = 1) {
        return $this->update($user_id, array('is_profile_complete', $value));
    }

    public function add_coupon($user_id, $coupon_id) {

        if ($this->is_profile_complete($user_id)) {
            if (is_numeric($coupon_id) && $this->is_valid_coupon($coupon_id)) {
                $ci = & get_instance();
                $ci->load->model('coupon_model', 'coupon');

                return $ci->coupon->grab_coupon($coupon_id, $user_id);
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function get_my_coupon($user_id, $coupon_id) {

    }

    public function get_my_coupons($user_id) {
        $ci = & get_instance();
        $ci->load->model('user_coupon_model', 'user_coupon');
        $couponz = $ci->user_coupon->get_coupons_for($user_id);
        if (empty($couponz)) {
            return FALSE;
        } else {
            return $couponz;
        }
    }

    private function _create_session($user) {
        if (@property_exists($user, 'coupons')) {
            $coups = $user->coupons;
        } else {
            $coups = array();
        }
        $data = array(Home::USER_SESSION_VARIABLE => array('id' => $user->id,
                'timestamp' => time(),
                'coupons' => $coups,
                'email' => $user->email
            ),
            'user_logged_in' => true);
        $this->session->set_userdata($data);
    }

    private function is_valid_coupon($coupon_id) {
        $ci = & get_instance();
        $ci->load->model('coupon_model', 'coupon');
        $coupon = $ci->coupon->get($coupon_id);
        if (!$coupon) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     *
     *  $coupon_code = $ci->coupon->get($coupon_id)->coupon_code;
      $user_coupon_code = $ci->coupon->generate_user_coupon($coupon_code, $user->email);

      $ci->load->model('user_coupon_model', 'users_coupons');
      $resp = $ci->users_coupons->insert(
      array(
      'user_id' => $user_id,
      'coupon_id' => $coupon_id,
      'user_coupon_code' => $user_coupon_code
      ));

      if (!$resp)
      return $resp;
      else
      return $user_coupon_code;
     */
}
