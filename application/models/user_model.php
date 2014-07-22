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
            'rules' => 'trim|required|valid_email|is_unique[users.email]'),
        array('field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required')
    );

    public function encrypt_password($row) {
        $row['password'] = sha1($row['password']);
        return $row;
    }

    public function login_email($email, $password) {
        $user = $this
                ->with('coupons')
                ->get_by(array('email' => $email, 'password' => sha1($password)));
        if (!empty($user) && is_object($user)) {
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
            return $query->row;
        } else {
            return FALSE;
        }
    }

    public function enable_fb_oauth($email, $fb_id) {
        $user = $this->get_by(array('email' => $email));
        if (!$user) {
            return FALSE;
        } else {
            $this->update($user->id, array('fb_oauth_id' => $fb_id, 'oauth_enabled' => 1));
            return $this->get_by(array('email' => $email));
        }
    }

    public function create_fb($data) {
        $id = $this->insert($data);
        return $id;
    }

    public function login_fb($email, $fb_id) {
        return $this->get_by(array('email' => $email, 'fb_oauth_id' => $fb_id));
    }

}
