<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Coupon_sale_model extends MY_Model {

    public $protected_attributes = array('id');
    public $belongs_to = array('coupon' => array('model' => 'coupon_model', 'primary_key' => 'coupon_id'));
    private $COUNT = "sales_count";
    private $DATE = "sales_date";
    private $USER_IDS = "json_user_ids";
    private $COUPON_ID = "coupon_id";
    private $COMMISSION = "sales_commission";
    private $PURCHASE_PRICE_COLUMN = 'purchase_price';
    private $USER_ID_COLUMN = 'user_id';

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

    public function get_views_by_month($date, $coupon_id = NULL) {
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
                $total += $value->sales_count;
            }
            return $total;
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

    public function get_all_time_sales($coupon_id = NULL) {
        if (is_null($coupon_id)) {
            $response = $this->with('coupon')->order_by('sales_count', 'DESC')->get_all();
            if (!$response) {
                return 0;
            } else {
                $total = 0;
                foreach ($response as $value) {
                    $total += $this->fetch_user_price_sum($value->json_user_ids);
                }
                return array('total' => $total, 'top_performing' => array_slice($response, 0, 5));
            }
        } else {
            $query = array($this->COUPON_ID => $coupon_id);
            $response = $this->get_by($query);
            if (!$response) {
                return 0;
            } else {
                return $this->fetch_user_price_sum($response->json_user_ids);
            }
        }
    }

    public function get_views_by_date($date = NULL, $coupon_id = NULL) {
        if (!is_null($date)) {
            $s_unix = human_to_unix($date);
            $date = date('Y-m-d', $s_unix);
        } else {
            $date = date('Y-m-d');
        }
        if (is_null($coupon_id)) {
            $query = array($this->DATE => $date);
            $response = $this->order_by('sales_count', 'DESC')
                    ->with('coupon')
                    ->get_many_by($query);
            if (!$response) {
                return 0;
            } else {
                $total = 0;
                $revenue = 0;
                foreach ($response as $value) {
                    $total += $value->sales_count;
                    $revenue += $this->fetch_user_price_sum($value->json_user_ids);
                }
                return array('total' => $total,
                    'revenue' => $revenue,
                    'average' => $total > 0 ? ($revenue / $total) : 0,
                    'top_performing' => array_slice($response, 0, 5));
            }
        } else {
            $query = array($this->DATE => $date, $this->COUPON_ID => $coupon_id);
            $response = $this->get_by($query);
            if (!$response) {
                return 0;
            } else {
                return $response->sales_count;
            }
        }
    }

    public function get_by_date_range($from = NULL, $to = NULL, $coupon_id = NULL) {
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

    public function get_earnings_by_month($date = NULL, $coupon_id = NULL) {
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
            $sales_count = 0;
            foreach ($response as $value) {
                $total += $this->fetch_user_price_sum($value->json_user_ids);
                $sales_count += $value->sales_count;
            }
            if (is_null($coupon_id)) {
                array('total' => $total, 'sales_count' => $sales_count, 'average' => $sales_count > 0 ? ($total / $sales_count) : 0);
            } else {
                return $total;
            }
        }
    }

    public function get_earnings_by_date($date, $coupon_id) {
        if (!is_null($date)) {
            $s_unix = human_to_unix($date);
            $date = date('Y-m-d', $s_unix);
        } else {
            $date = date('Y-m-d');
        }
        if (is_null($coupon_id)) {
            $query = array($this->DATE => $date);
            $response = $this->get_many_by($query);
            if (!$response) {
                return 0;
            } else {
                $total = 0;
                foreach ($response as $value) {
                    $total += $this->fetch_user_price_sum($value->json_user_ids);
                }
                return $total;
            }
        } else {
            $query = array($this->DATE => $date, $this->COUPON_ID => $coupon_id);
            $response = $this->get_by($query);
            if (!$response) {
                return 0;
            } else {
                return $this->fetch_user_price_sum($response->json_user_ids);
            }
        }
    }

    public function fetch_user_price_sum($json) {
        $array = json_decode($json, TRUE);
        $total = 0;
        foreach ($array as $value) {
            $total += (int) $value[$this->PURCHASE_PRICE_COLUMN];
        }

        return $total;
    }

}
