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

    public function increase_sale($coupon_id, $user_id) {
        $date = date('Y-m-d');
        $data = array('coupon_id' => $coupon_id, $this->DATE => $date);
        $coupon = $this->as_array()->get_by($data);
        if (!$coupon) {
            $data[$this->USER_IDS] = json_encode(array($user_id));
            $data[$this->COUNT] = 1;
            return $this->create_new_view($data);
        } else {
            $temp = json_decode($coupon[$this->USER_IDS], TRUE);
            $temp[] = $user_id;
            $coupon[$this->USER_IDS] = $temp;
            $coupon[$this->COUNT] = $coupon[$this->COUNT] + 1;
            return $this->update($coupon['id'], $coupon);
        }
    }

    public function get_total_count($coupon_id) {
        if (!is_null($coupon_id)) {
            return $this->count_by(array($this->COUPON_ID => $coupon_id));
        } else {
            return $this->count_all();
        }
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
            return FALSE;
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

}
