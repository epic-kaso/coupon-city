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

    const USER_SESSION_VARIABLE = "user";

    public $protected_attributes = array('id');
    public $before_create = array('created_at', 'updated_at', 'encrypt_password', 'verify_balance');
    public $has_many = array(
        'activities' => array('model' => 'user_activity_model', 'primary_key' => 'user_id'),
        'coupons' => array('model' => 'user_coupon_model', 'primary_key' => 'user_id'),
        'wallet' => array('model' => 'wallet_model', 'primary_key' => 'user_id')
    );
    public $after_get = array('add_status_field', 'format_wallet_balance');
    public $validate = array(
        array('field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email|is_unique[users.email]'),
        array('field' => 'password',
            'label' => 'password',
            'rules' => 'trim')
    );

    //------------------------------------------------
    //------------------------------------------------
    //-------------------USER RELATED-----------------


    public function encrypt_password($row) {
        if (array_key_exists('password', $row)) {
            $row['password'] = sha1($row['password']);
        }
        return $row;
    }

    public function add_status_field($row) {
        $is_complete = $row->is_profile_complete;
        if ($is_complete === 1) {
            $row->status = 'Complete';
        } else {
            $row->status = 'Incomplete';
        }
        return $row;
    }

    public function login_email($email, $password) {

        $user = $this
                ->with('coupons')
                ->get_by(array('email' => $email, 'password' => sha1($password)));

        if (!empty($user) && is_object($user)) {
            $user->wallet = $this->get_wallet($user->id);
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
        $ci = & get_instance();
        $ci->load->model('user_coupon_model', 'user_coupon');
        $couponz = $ci->user_coupon->get_coupon($user_id, $coupon_id);
        if (empty($couponz)) {
            return FALSE;
        } else {
            return $couponz;
        }
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
        $data = array(Home::USER_SESSION_VARIABLE =>
            array('id' => $user->id,
                'email' => $user->email
        ));
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

    public function get_current() {
        $d = $this->session->userdata(self::USER_SESSION_VARIABLE);
        return $this->get($d['id']);
    }

    public function profile_info($user) {
        $user = get_object_vars($user);
        $keys = array('email',
            'is_profile_complete',
            'created_at',
            'updated_at',
            'id',
            'status',
            'password',
            'active',
            'activation_code',
            'oauth_enabled',
            'fb_oauth_id');

        foreach ($keys as $v) {
            if (array_key_exists($v, $user)) {
                unset($user[$v]);
            }
        }
        foreach ($user as $key => $value) {
            unset($user[$key]);
            $key = ucwords(str_ireplace('_', ' ', $key));
            $user[$key] = $value;
        }

        return $user;
    }

    //----------------------------------------------------
    //-------------------------------------------------------
    //--------------WALLET RELATED---------------------------


    public function verify_balance($row) {
        if (is_object($row)) {
            $balance = $row->wallet_balance;
            if (is_numeric($balance)) {
                $row->wallet_balance = $balance;
            } else {
                $row->wallet_balance = 0;
            }
        } else {
            $balance = $row['wallet_balance'];
            if (is_numeric($balance)) {
                $row['wallet_balance'] = $balance;
            } else {
                $row['wallet_balance'] = 0;
            }
        }
        return $row;
    }

    public function format_wallet_balance($row) {
        if (is_object($row)) {
            $balance = $row->wallet_balance;
            $row->wallet_balance = number_format($balance, 2);
        } else {
            $balance = $row['wallet_balance'];
            $row['wallet_balance'] = number_format($balance, 2);
        }
        return $row;
    }

    public function get_wallet($user_id) {
        return $this->get_wallet_balance($user_id);
    }

    public function get_wallet_balance($user_id) {
        $wallet = $this->get($user_id)->wallet_balance;
        if (!$wallet) {
            return 0;
        } else {
            return $wallet;
        }
    }

    public function credit_wallet($user_id, $amount) {
        $wallet = $this->get($user_id)->wallet_balance;
        $current_balance = $wallet;
        $current_balance -= $amount;

        return $this->update($user_id, array('wallet_balance' => $current_balance));
    }

    public function debit_wallet($user_id, $amount) {
        $wallet = $this->get($user_id)->wallet_balance;
        $current_balance = $wallet;
        $current_balance -= $amount;

        return $this->update($user_id, array('wallet_balance' => $current_balance));
    }

}
