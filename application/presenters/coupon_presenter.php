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
                foreach ($this->data as $row) {
                    $this->process($row);
                }
                return $this->data;
            } else {
                return $this->process($this->data);
            }
        }
    }

    private function process($row) {
        $row->remaining = $this->_calculate_remaining_time($row->start_date, $row->end_date);
        $row->link = base_url('coupon/' . $row->slug);
        $this->create_summary($row);
        return $row;
    }

    public function featured_item() {
        $this->load->model('coupon_model');
        $count = $this->coupon_model->count_all();
        $seed = rand(1, $count);
        $row = $this->coupon_model->get($seed);
        if (empty($row) || $row == FALSE) {
            $row = new Couponview();
            $row->empty = true;
            $row->name = 'No Coupon Available';
            $row->description = "N/A";
        } else {
            $row->remaining = $this->_calculate_remaining_time($row->start_date, $row->end_date);
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
