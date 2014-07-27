<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wallet_transaction_model
 *
 * @author kaso
 */
class Wallet_transaction_model extends MY_Model {

    public $_table = 'wallet_transactions';
    public $protected_attributes = array('id');
    public $belongs_to = array('user' => array('model' => 'user_model'));

    //public $has_many = array('comments' => array('model' => 'model_comments'));


    public function generate_transaction_code($user_id, $amount) {
        //transaction_id+user_id+amount
        $ci = & get_instance();
        $ci->load->model('wallet_model', 'wallet');
        $wallet = $ci->wallet->get_user_wallet($user_id);

        $id = $this->insert(array('user_id' => $user_id, 'wallet_id' => $wallet->id, 'transaction_amount' => $amount));
        if (!$id) {
            return FALSE;
        } else {
            return $this->encode($id, $user_id, $amount);
        }
    }

    public function authenticate_transaction_code($code) {
        //transaction_id+user_id+amount
        $params = $this->decode($code);
        if (count($params) !== 3) {
            return FALSE;
        } else {
            $id = $params[0];
            $user_id = $params[1];
            $amount = $params[2];

            $response = array('id' => $id, 'user_id' => $user_id, 'transaction_amount' => $amount);
            if ($this->is_complete($id)) {
                return FALSE;
            } else {
                return $response;
            }
        }
    }

    public function is_complete($id) {
        $v = $this->get($id);
        return $v->is_completed === 1;
    }

    public function complete_transaction($id) {
        if (!$this->is_complete($id)) {
            $this->update($id, array('is_completed' => 1));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function encode($id, $user_id, $amount) {
        return base64_encode(trim($id) . '+' . trim($user_id) . '+' . trim($amount));
    }

    private function decode($code) {
        $raw = base64_decode(trim($code));
        $params = explode('+', $raw);
        return $params;
    }

}
