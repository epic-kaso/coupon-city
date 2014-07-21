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
class Coupon_media_model extends MY_Model {

    public $_table = 'coupons_medias';
    public $protected_attributes = array('id');
    public $belongs_to = array('coupon' => array('model' => 'coupon_model'));

    //public $has_many = array('comments' => array('model' => 'model_comments'));
    //put your code here
}
