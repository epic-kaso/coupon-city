<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Coupon_sale_model extends MY_Model {

    public $protected_attributes = array('id');
    private $COUNT = "sales_count";
    private $DATE = "sales_date";
    private $USER_IDS = "json_user_ids";
    private $COUPON_ID = "coupon_id";
    private $COMMISSION = "sales_commission";

    const COMMISION_PERCENT = 20.0;

    public function increase_sale($coupon_id, $user_id) {
        $date = date('Y-m-d');
        $data = array('coupon_id' => $coupon_id, $this->DATE => $date);
        $coupon_sale = $this->as_array()->get_by($data);

        $ci = & get_instance();
        $ci->load->model('coupon_model', 'coupon');
        $coupon = $ci->coupon->get($coupon_id);
        if (!$coupon_sale) {
            $data[$this->USER_IDS] = json_encode(array(array('user_id' => $user_id, 'purchase_price' => $coupon->unformated_new_price)));
            $data[$this->COUNT] = 1;
            $data[$this->COMMISSION] = $this->calculate_commision($coupon);
            return $this->create_new_view($data);
        } else {
            $temp = json_decode($coupon_sale[$this->USER_IDS], TRUE);
            $temp[] = array('user_id' => $user_id, 'purchase_price' => $coupon->unformated_new_price);
            $coupon_sale[$this->USER_IDS] = json_encode($temp);
            $coupon_sale[$this->COUNT] = $coupon_sale[$this->COUNT] + 1;
            $coupon_sale[$this->COMMISSION] = $coupon_sale[$this->COMMISSION] + $this->calculate_commision($coupon);
            return $this->update($coupon_sale['id'], $coupon_sale);
        }
    }

    public function get_total_count($coupon_id) {
        $total = 0;
        if (!is_null($coupon_id)) {
            $v = $this->get_many_by(array($this->COUPON_ID => $coupon_id));
        } else {
            $v = $this->count_all();
        }
        if (!$v) {
            return 0;
        }
        foreach ($v as $key => $value) {
            if (is_object($value)) {
                $total += $value->sales_count;
            } else {
                $total += $value['sales_count'];
            }
        }
        return $total;
    }

    private function create_new_view($data) {
        $this->insert($data);
    }

    public function get_views_by_date($date, $coupon_id = NULL) {
        if (!is_null($date)) {
            $s_unix = human_to_unix($date);
            $date = date('Y-m-d', $s_unix);
        } else {
            $date = date('Y-m-d');
        }
        if (is_null($coupon_id)) {
            $query = array($this->DATE => $date);
            return $this->get_many_by($query);
        } else {
            $query = array($this->DATE => $date, $this->COUPON_ID => $coupon_id);
            return $this->get_by($query);
        }
    }

    public function get_by_date_range($from, $to = NULL, $coupon_id = NULL) {
        if (is_null($to)) {
            $to = Date('yyyy-mm-dd');
        }
        if (is_null($from)) {
            $from = $to;
        }

        $s_unix = human_to_unix($from);
        $from = date('Y-m-d', $s_unix);

        $t_unix = human_to_unix($to);
        $to = date('Y-m-d', $t_unix);

        if (is_null($coupon_id)) {
            $sql = "SELECT * FROM " . $this->_table . " WHERE " . $this->DATE .
                    " >= ? AND " . $this->DATE . " <= ?";
            $query_d = array($from, $to);
        } else {
            $sql = "SELECT * FROM " . $this->_table . " WHERE " . $this->COUPON_ID .
                    " = ? AND " . $this->DATE . " >= ? AND " . $this->DATE . " <= ?";
            $query_d = array($coupon_id, $from, $to);
        }

        $response = $this->db->query($sql, $query_d);
        return $response->result();
    }

    public function calculate_commision($row) {
        if (is_object($row)) {
            $old_price = $row->unformated_old_price;
            $new_price = $row->unformated_new_price;
            $commision = ceil(($old_price - $new_price) / 100 * self::COMMISION_PERCENT);
        } else {
            $old_price = $row['unformated_old_price'];
            $new_price = $row['unformated_new_price'];
            $commision = ceil(($old_price - $new_price) / 100 * self::COMMISION_PERCENT);
        }
        return $commision;
    }

}
