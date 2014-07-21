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
class Category_model extends MY_Model {

    public $_table = 'category';
    public $protected_attributes = array('id');
    public $before_create = array('create_slug');

    public function create_slug($row) {
        if (is_object($row)) {
            $slug = $row->name;
            $row->slug = $this->_process_slug($slug);
        } else {
            $slug = $row['name'];
            $row['slug'] = $this->_process_slug($slug);
        }
        return $row;
    }

    public function _process_slug($slug) {
        $response = str_replace('&', 'and', strtolower($slug));
        return url_title($response);
    }

}
