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

    const DEFAULT_MEDIA_URL = "assets/images/no_image.png";

    public $_table = 'coupons_medias';
    public $protected_attributes = array('id');
    public $belongs_to = array('coupon' => array('model' => 'coupon_model'));

    //public $has_many = array('comments' => array('model' => 'model_comments'));
    //put your code here


    public function get_cover_media($coupon_id) {
        $coupon_media = $this->get_by(array('coupon_id' => $coupon_id));
        if (!$coupon_media) {
            return FALSE;
        } else {
            return $coupon_media->media_url;
        }
    }

}
