<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once APPPATH . 'presenters/presenter.php';

class Coupon_presenter extends Presenter {

    public function __construct($object) {
        parent::__construct($object);
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
        $row->grab_link = base_url('grab_coupon/' . $row->slug);
        $this->create_summary($row);
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
            $this->create_summary($row);
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
