<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of coupon_model
 *
 * @author kaso
 */
class Coupon_model extends MY_Model {

    public $protected_attributes = array('id');
    public $before_create = array('ensure_unique_slug', 'created_at', 'updated_at', 'calculate_discount', 'calculate_commision', 'transform_start_end_date');
    public $after_get = array('format_numbers');
    public $has_many = array('coupon_media' => array('model' => 'coupon_media_model', 'primary_key' => 'coupon_id'));
    public $belongs_to = array('merchant' => array('model' => 'merchant_model'));
    public $validate = array(
        array('field' => 'name',
            'label' => 'name',
            'rules' => 'trim|required'),
        array('field' => 'description',
            'label' => 'description',
            'rules' => 'trim|required'),
        array('field' => 'old_price',
            'label' => 'old_price',
            'rules' => 'trim|required'),
        array('field' => 'new_price',
            'label' => 'new_price|callback_is_valid_new_price[old_price]',
            'rules' => 'trim|required'),
        array('field' => 'category_id',
            'label' => 'category_id',
            'rules' => 'trim|required'),
        array('field' => 'merchant_id',
            'label' => 'merchant_id',
            'rules' => 'trim|required'),
        array('field' => 'start_date',
            'label' => 'start_date',
            'rules' => 'trim|required'),
        array('field' => 'end_date',
            'label' => 'end_date',
            'rules' => 'trim|required')
    );

    public function get_by_slug($slug) {
        return $this->get_by(array('slug' => $slug));
    }

    public function calculate_discount($row) {
        if (is_object($row)) {
            $old_price = $row->old_price;
            $new_price = $row->new_price;
            $row->discount = ($old_price - $new_price) / $old_price * 100.0;
        } else {
            $old_price = $row['old_price'];
            $new_price = $row['new_price'];
            $row['discount'] = ($old_price - $new_price) / $old_price * 100.0;
        }
        return $row;
    }

    public function calculate_commision($row) {
        if (is_object($row)) {
            $old_price = $row->old_price;
            $new_price = $row->new_price;
            $row->commision = ceil(($old_price - $new_price) / 100 * 10.0);
        } else {
            $old_price = $row['old_price'];
            $new_price = $row['new_price'];
            $row['commision'] = ceil(($old_price - $new_price) / 100 * 10.0);
        }
        return $row;
    }

    public function format_numbers($row) {
        if (@property_exists($row, 'discount')) {
            $balance = $row->discount;
            $row->discount = number_format($balance, 2);
        }
        if (@property_exists($row, 'old_price')) {
            $old_price = $row->old_price;
            $row->old_price = number_format($old_price, 2);
        }
        if (@property_exists($row, 'old_price')) {
            $new_price = $row->new_price;
            $row->new_price = number_format($new_price, 2);
        }
        return $row;
    }

    public function transform_start_end_date($row) {
        if (is_object($row)) {
            $start_date = $row->start_date;
            $end_date = $row->end_date;
        } else {
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
        }
        $s_unix = human_to_unix($start_date);
        $e_unix = human_to_unix($end_date);
        $start_date = date('Y-m-d H:i:s', $s_unix);
        $end_date = date('Y-m-d H:i:s', $e_unix);
        if (is_object($row)) {
            $row->start_date = $start_date;
            $row->end_date = $end_date;
        } else {
            $row['start_date'] = $start_date;
            $row['end_date'] = $end_date;
        }
        return $row;
    }

    public function is_valid_new_price($new_price, $old_price) {
        $n_price = (int) $new_price;
        $o_price = (int) $old_price;

        if ($o_price > $n_price) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function ensure_unique_slug($row) {
        $db = DB('default');
        $query = $db->limit(1)->get_where($this->_table, array('slug' => $row->slug));

        $db->close();
        if ($query->num_rows() !== 0) {
            return $this->increase_slug_name($row->slug);
        } else {
            return $row;
        }
    }

    public function increase_slug_name($slug) {
        $this->load->helper('string');
        return increment_string($slug, '_');
    }

    public function search($query, $location = null) {
        if (empty($query)) {
            throw new Exception('query string cant be null');
        }
        if (empty($location)) {
            return $this->search_many_by(array('name' => $query));
        } else {
            return $this->search_many_by(array('name' => $query, 'location' => $location));
        }
    }

    public function count_search($query, $location = null, $with_descripton = FALSE) {
        $query_array = array('name' => $query, 'location' => $location);
        $query_array_descriptn = array('description' => $query, 'location' => $location);

        if (!$with_descripton) {
            if (empty($query)) {
                throw new Exception('query string cant be null');
            }
            if (empty($location)) {
                unset($query_array['location']);
            }
            return $this->count_likes_by($query_array);
        } else {
            if (empty($query)) {
                throw new Exception('query string cant be null');
            }
            if (empty($location)) {
                unset($query_array_descriptn['location']);
                unset($query_array['location']);
            }
            $result_1 = $this->count_likes_by($query_array);
            $result_2 = $this->count_likes_by($query_array_descriptn);
            return array_merge($result_1, $result_2);
        }
    }

}
