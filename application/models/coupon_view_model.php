<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Coupon_view_model extends MY_Model {

    public $protected_attributes = array('id');
    private $COUPON_ID = "coupon_id";

    public function increase_view($coupon_id) {
        $date = date('Y-m-d');
        $data = array($this->COUPON_ID => $coupon_id, 'view_date' => $date);
        $coupon = $this->as_array()->get_by($data);
        if (!$coupon) {
            $data['view_count'] = 1;
            return $this->create_new_view($data);
        } else {
            $coupon['view_count'] = $coupon['view_count'] + 1;
            return $this->update($coupon['id'], $coupon);
        }
    }

    private function create_new_view($data) {
        $this->insert($data);
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
                $total += $value->view_count;
            } else {
                $total += $value['view_count'];
            }
        }
        return $total;
    }

    public function get_views_by_month($date = NULL, $coupon_id = NULL) {
        if (is_null($date)) {
            $date = Carbon::createFromDate(NULL, NULL, 1);
        }

        $start = $date;
        $end = Carbon::createFromDate();

        $response = $this->get_by_date_range($start, $end, $coupon_id);
        if (!$response) {
            return 0;
        } else {
            $total = 0;
            foreach ($response as $value) {
                $total += $value->view_count;
            }
            return $total;
        }
    }

    public function get_views_by_date($date, $coupon_id = NULL) {
        if (!is_null($date)) {
            $s_unix = human_to_unix($date);
            $date = date('Y-m-d', $s_unix);
        } else {
            $date = date('Y-m-d');
        }
        if (is_null($coupon_id)) {
            $query = array('view_date' => $date);
            $response = $this->order_by('view_count', 'DESC')->get_many_by($query);
            if (!$response) {
                return 0;
            } else {
                $total = 0;
                foreach ($response as $value) {
                    $total += $value->view_count;
                }
                return array('total' => $total, 'top_performing' => array_slice($response, 0, 5));
            }
        } else {
            $query = array('view_date' => $date, 'coupon_id' => $coupon_id);
            $response = $this->get_by($query);
            if (!$response) {
                return 0;
            } else {
                return $response->view_count;
            }
        }
    }

    public function get_all_time_views($coupon_id = NULL) {
        if (is_null($coupon_id)) {
            $response = $this->order_by('view_count', 'DESC')->get_all();
            if (!$response) {
                return 0;
            } else {
                $total = 0;
                foreach ($response as $value) {
                    $total += $value->view_count;
                }
                return array('total' => $total, 'top_performing' => array_slice($response, 0, 5));
            }
        } else {
            $query = array('coupon_id' => $coupon_id);
            $response = $this->get_by($query);
            if (!$response) {
                return 0;
            } else {
                return $response->view_count;
            }
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
            $sql = "SELECT * FROM " . $this->_table . " WHERE view_date >= ? AND view_date <= ?";
            $query_d = array($from, $to);
        } else {
            $sql = "SELECT * FROM " . $this->_table . " WHERE " . $this->COUPON_ID .
                    " = ? AND view_date >= ? AND view_date <= ?";
            $query_d = array($coupon_id, $from, $to);
        }

        $response = $this->db->query($sql, $query_d);
        return $response->result();
    }

}
