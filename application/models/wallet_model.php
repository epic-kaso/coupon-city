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
class Wallet_model extends MY_Model {

    public $_table = 'wallet';
    public $protected_attributes = array('id');
    public $before_create = array('verify_balance');
    public $after_get = array('format_numbers');
    public $belongs_to = array('user' => array('model' => 'user_model'));

    public function verify_balance($row) {
        if (is_object($row)) {
            $balance = $row->balance;
            if (is_numeric($balance)) {
                $row->balance = $balance;
            } else {
                $row->balance = 0;
            }
        } else {
            $balance = $row['balance'];
            if (is_numeric($balance)) {
                $row['balance'] = $balance;
            } else {
                $row['balance'] = 0;
            }
        }
        return $row;
    }

    public function format_numbers($row) {
        $balance = $row->balance;
        $row->balance = number_format($balance, 2);
        return $row;
    }

}
