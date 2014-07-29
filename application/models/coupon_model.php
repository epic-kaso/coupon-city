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

    const COMMISION_PERCENT = 20.0;

    private $key = "CouponCity1234,.+@#";
    private $JOIN_CHAR = "_";
    public $protected_attributes = array('id');
    public $before_create = array('ensure_unique_slug', 'created_at', 'updated_at',
        'calculate_discount', 'calculate_commision', 'transform_start_end_date', 'advanced_pricing_to_json');
    public $after_get = array('advanced_pricing_to_object', 'update_status', 'format_numbers', 'get_coupon_cover_image');
    public $has_many = array('coupon_medias' => array('model' => 'coupon_media_model', 'primary_key' => 'coupon_id'));
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
            $row->commision = ceil(($old_price - $new_price) / 100 * Coupon_model::COMMISION_PERCENT);
        } else {
            $old_price = $row['old_price'];
            $new_price = $row['new_price'];
            $row['commision'] = ceil(($old_price - $new_price) / 100 * Coupon_model::COMMISION_PERCENT);
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

    public function update_status($row) {
        if (is_object($row)) {
            $start_date = $row->start_date;
            $end_date = $row->end_date;
        } else {
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
        }
        $e_unix = human_to_unix($end_date);
        $status = date('U') >= $e_unix ? 0 : 1;
        if (is_object($row) && !is_null($status)) {
            $row->deal_status = $status;
            $this->update($row->id, get_object_vars($row));
        } else if (!is_null($status)) {
            $row['deal_status'] = $status;
            $this->update($row['id'], $row);
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

    public function advanced_pricing_to_json($row) {
        if (is_object($row)) {
            $advanced_pricing = $row->advanced_pricing;
        } else {
            $advanced_pricing = $row['advanced_pricing'];
        }
        if (is_array($advanced_pricing)) {
            $jsn = json_encode($advanced_pricing);
            if (is_object($row)) {
                $row->is_advanced_pricing = 1;
                $row->advanced_pricing = $jsn;
            } else {
                $row['is_advanced_pricing'] = 1;
                $row['advanced_pricing'] = $jsn;
            }
        } else {
            if (is_object($row)) {
                $row->is_advanced_pricing = 0;
            } else {
                $row['is_advanced_pricing'] = 0;
            }
        }
        return $row;
    }

    //--COUPON READ RELATED METHODS---------------

    public function get_by_slug($slug) {
        return $this->with('coupon_medias')->get_by(array('slug' => $slug));
    }

    public function advanced_pricing_to_object($row) {
        if ($row->is_advanced_pricing === 1) {
            if (is_object($row)) {
                $obj = json_decode($row->advanced_pricing, true);
                $row->advanced_pricing = $obj;
            } else {
                $obj = json_decode($row['advanced_pricing'], true);
                $row['advanced_pricing'] = $obj;
            }
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

    public function get_coupon_cover_image($row) {
        $ci = & get_instance();
        $ci->load->model('coupon_media_model', 'media');
        $image_url = $ci->media->get_cover_media($row->id);
        if (!$image_url) {
            $row->cover_image_url = Coupon_media_model::DEFAULT_MEDIA_URL;
        } else {
            $row->cover_image_url = $image_url;
        }
        return $row;
    }

    public function search($query, $location = null, $with_descripton = FALSE) {
        $query_array = array('name' => $query, 'location' => $location);
        $query_array_descriptn = array('description' => $query, 'location' => $location);

        if (!$with_descripton) {
            if (empty($query)) {
                throw new Exception('query string cant be null');
            }
            if (empty($location)) {
                unset($query_array['location']);
            }
            return $this->search_many_by($query_array);
        } else {
            if (empty($query)) {
                throw new Exception('query string cant be null');
            }
            if (empty($location)) {
                unset($query_array_descriptn['location']);
                unset($query_array['location']);
            }
            $result_1 = $this->search_many_by($query_array);
            $result_2 = $this->search_many_by($query_array_descriptn);
            return array_merge($result_1, $result_2);
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

    public function grab_coupon($coupon_id, $user_id) {
        if (!is_numeric($coupon_id) || !is_numeric($user_id)) {
            return FALSE;
        }
        $CI = & get_instance();
        $CI->load->model('wallet_model', 'wallet');
        $CI->load->model('user_model', 'user');
        $CI->load->model('user_coupon_model', 'user_coupon');

        $coupon = $this->get($coupon_id);
        $user = $CI->user->get($user_id);

        $wallet_balance = $CI->wallet->get_user_wallet_balance($user_id);

        $amt = $this->_calculate_coupon_price($coupon);
        if ($wallet_balance >= $amt) {
            $CI->wallet->debit_wallet($user_id, $amt);
            $user_coupon = $this->generate_user_coupon($coupon->coupon_code, $user->email);
            $CI->user_coupon->insert(
                    array(
                        'coupon_id' => $coupon_id,
                        'user_id' => $user_id,
                        'user_coupon_code' => $user_coupon
            ));

            return $user_coupon;
        } else {
            return array('error' => 'Insufficient Account balance');
        }
    }

    public function get_coupons_similar_to($coupon_id, $limit = 4) {
        $coupon = $this->get($coupon_id);
        return $this->limit($limit)
                        ->search_many_by(array('name' => $coupon->name));
    }

    //-- UTILITY METHODS

    public function generate_user_coupon($coupon_code, $user_email) {
        $ci = & get_instance();
        $ci->load->library('encrypt');
        return $ci->encrypt->encode($coupon_code . $this->JOIN_CHAR . $user_email, $this->key);
    }

    public function validate_user_coupon($code) {
        $info = $this->retrieve_coupon_code($code);
        $ci = & get_instance();
        if (!$info) {
            return FALSE;
        }
        $email = $info['email'];
        $coupon_code = $info['coupon_code'];

        $coupon = $this->get_by(array('coupon_code' => $coupon_code));
        $ci->load->model('user_model', 'user');
        $user = $ci->user->get_by(array('email' => $email));
        if (!$coupon || !$user) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function retrieve_coupon_code($code) {
        $ci = & get_instance();
        $ci->load->library('encrypt');
        $enc = explode($this->JOIN_CHAR, $ci->encrypt->decode($code, $this->key));
        if (is_array($enc) && count($enc) >= 2) {
            return array('coupon_code' => $enc[0], 'email' => $enc[1]);
        } else {
            return FALSE;
        }
    }

    private function _calculate_coupon_price($coupon) {

        return $coupon->new_price;
    }

    public function is_deal_open($coupon_id) {
        $coupon = $this->get($coupon_id);
        if (!$coupon) {
            return FALSE;
        } else {
            return $coupon->deal_status === 1;
        }
    }

    public function is_advanced_price($coupon_id) {
        $coupon = $this->get($coupon_id);
        if (!$coupon) {
            return FALSE;
        } else {
            return $coupon->is_advanced_pricing === 1;
        }
    }

    public function coupon_quantity($coupon) {
        if (is_object($coupon)) {
            $q = $coupon->quantity;
            return empty($q) ? 0 : $q;
        } else if (is_numeric($coupon)) {
            $c = $this->get($coupon);
            if (!$c) {
                return FALSE;
            } else {
                $q = $c->quantity;
                return empty($q) ? 0 : $q;
            }
        }
        return FALSE;
    }

    public function test_encrpt() {
        $c_code = 'sghjkl;lkjhgfghjkl;lkjhgfdfghjk';
        $email = 'akason47@gmail.com';
        $value = $this->generate_user_coupon($c_code, $email);

        $resp = $this->retrieve_coupon_code($value);

        $test = $resp['coupon_code'] === $c_code;

        $expected_result = TRUE;

        $test_name = 'Adds one plus one';

        $ci = & get_instance();
        $ci->load->library('unit_test');
        $ci->unit->run($test, $expected_result, $test_name);

        echo $ci->unit->report();
    }

}
