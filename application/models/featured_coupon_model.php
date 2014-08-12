<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of featured_coupon
 *
 * @author kaso
 */
class featured_coupon_model extends MY_Model {

    public $protected_attributes = array('id');
    public $belongs_to = array('coupon' => array('model' => 'coupon_model', 'primary_key' => 'coupon_id'));

}
