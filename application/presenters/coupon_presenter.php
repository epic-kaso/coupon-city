<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once APPPATH . 'presenters/presenter.php';

class Coupon_presenter extends Presenter {

    protected $is_merchant;

    public function __construct($object, $merchant = FALSE) {
        parent::__construct($object);
        $this->is_merchant = $merchant;
        $this->load->helper('date');
        $this->load->helper('text');
    }

    public function items() {
        if (empty($this->data)) {
            $row = new stdClass();
            $row->empty = true;
            $row->name = 'No Coupon Available';
            return array($row);
        } else {
            if (is_array($this->data)) {
                foreach ($this->data as $key => $row) {
                    if ($row->deal_status == 0) {
                        unset($this->data[$key]);
                    } else {
                        $this->process($row);
                    }
                }
                return $this->data;
            } else {
                if ($this->data->deal_status == 0) {
                    redirect(base_url('coupon-not-found'));
                } else {
                    return $this->process($this->data);
                }
            }
        }
    }

    private function process($row) {
        $row->remaining = $this->_calculate_remaining_time($row->start_date, $row->end_date);
        $row->link = base_url('coupons/' . $row->slug);
        if (!is_null($row->quantity) && $row->quantity <= 0) {
            $row->inactive = TRUE;
            $row->grab_link = "";
        } else {
            $row->inactive = FALSE;
            $row->grab_link = base_url('grab_coupon/' . $row->slug);
        }
        $this->create_summary($row);
        if (!$this->is_merchant) {
            $this->add_merchant_params($row);
        } else {
            check_current_user_coupons($row);
        }
        return $row;
    }

    private function add_merchant_params($row) {
        $ci = & get_instance();
        $ci->load->model(array('coupon_sale_model', 'coupon_view_model', 'coupon_redemption_model'));
        $row->view_count = $ci->coupon_view_model->get_total_count($row->id);
        $row->sales_count = $ci->coupon_sale_model->get_total_count($row->id);
        $row->redemption_count = $ci->coupon_redemption_model->get_total_count($row->id);
        return $row;
    }

    private function check_current_user_coupons($row) {
        $ci = & get_instance();
        $ci->load->model(array('user_coupon_model', 'user_model'));

        $user = $ci->user_model->get_current();
        if (!$user) {
            return $row;
        } else {
            $status = $ci->user_coupon_model->user_owns_coupon($user->id, $row->id);
            if ($status) {
                $row->inactive = TRUE;
                $row->grab_link = "";
                $row->user_owns_coupon = TRUE;
            }
        }

        return $row;
    }

    public function featured_item($id = 1) {
        $this->load->model('coupon_model');
        $row = null; //$this->coupon_model->with('coupon_medias')->get($id);
        if (empty($row) || $row == FALSE) {
            return FALSE;
        } else {
            $row->remaining = $this->_calculate_remaining_time($row->start_date, $row->end_date);
            $row->grab_link = base_url('grab_coupon/' . $row->slug);
            if (!is_null($row->quantity) && $row->quantity <= 0) {
                $row->inactive = TRUE;
                $row->grab_link = "";
            } else {
                $row->inactive = FALSE;
                $row->grab_link = base_url('grab_coupon/' . $row->slug);
            }
            $this->create_summary($row);
            if (!$this->is_merchant) {
                $this->add_merchant_params($row);
            } else {
                check_current_user_coupons($row);
            }
        }
        return $row;
    }

    public function _calculate_remaining_time($start, $end) {
        $start_unix = mysql_to_unix($start);
        $end_unix = mysql_to_unix($end);

        return timespan($start_unix, $end_unix);
    }

    public function create_summary($row) {
        $row->summary = ellipsize($row->description, 30, 1);
    }

}

class Couponview {

    public function __get($param) {
        return 'N/A';
    }

}
