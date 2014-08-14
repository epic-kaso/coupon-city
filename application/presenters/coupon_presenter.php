<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once APPPATH . 'presenters/presenter.php';
require_once APPPATH . 'presenters/merchant_presenter.php';

class Coupon_presenter extends Presenter {

    protected $is_merchant = FALSE;

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
                    if (!$this->is_merchant && $row->deal_status == 0) {
                        unset($this->data[$key]);
                    } else {
                        $this->process($row);
                    }
                }
                return $this->data;
            } else {
                if (!$this->is_merchant && $this->data->deal_status == 0) {
                    redirect(base_url('coupon-not-found'));
                } else {
                    return $this->process($this->data);
                }
            }
        }
    }

    public function item() {
        if (empty($this->data)) {
            $row = new stdClass();
            $row->empty = true;
            $row->name = 'No Coupon Available';
            return array($row);
        }

        if (!$this->is_merchant &&
                is_object($this->data) &&
                property_exists($this->data, 'deal_status') &&
                $this->data->deal_status == 0) {
            print_r($this->data->deal_status);
            //redirect(base_url('coupon-not-found'));
        } else {
            return $this->process($this->data);
        }
    }

    private function process($row) {
        $row->remaining = $this->_calculate_remaining_time($row->start_date, $row->end_date);
        $row->link = base_url('coupon/' . $row->slug);
        $row->savings = $row->old_price - $row->new_price;
        $row->sales = $this->_get_sales_count($row->id);
        if (!is_null($row->quantity) && $row->quantity <= 0) {
            $row->inactive = TRUE;
            $row->grab_link = "";
        } else {
            $row->inactive = FALSE;
            $row->grab_link = base_url('grab_coupon/' . $row->slug);
        }
        $this->create_summary($row);
        if ($this->is_merchant) {
            $this->add_merchant_params($row);
        } else {
            $row = $this->check_current_user_coupons($row);
        }

        if (property_exists($row, 'merchant')) {
            $row->merchant = new Merchant_presenter($row->merchant);
        }
        return $row;
    }

    /*
     * advanced pricing spec
     * array=>'advanced_pricing'
     *  array=>'first'
     *          array=>'count','value'
     *          `      'price','value'
     *                 'discount',value
     *
     * array=>'second'
     *          array=>'count','value'
     *                 'price','value'
     *                  'discount',value
     * array=>'third'
     *          array=>'count','value'
     *                 'price','value'
     *                  'discount',value
     *
     */

    private function add_merchant_params($row) {
        $ci = & get_instance();
        $ci->load->model(array('coupon_sale_model', 'coupon_view_model', 'coupon_redemption_model'));

        $row->today_views = $ci->coupon_view_model->get_views_by_date(null, $row->id);
        $row->today_sales = $ci->coupon_sale_model->get_views_by_date(null, $row->id);
        $row->today_earnings = $ci->coupon_sale_model->get_earnings_by_date(null, $row->id);
        $row->today_redeemed = $ci->coupon_redemption_model->get_views_by_date(null, $row->id);
        $row->today_average = $row->today_sales == 0 ? 0 : $row->today_earnings / $row->today_sales;

        $row->month_views = $ci->coupon_view_model->get_views_by_month(null, $row->id);
        $row->month_sales = $ci->coupon_sale_model->get_views_by_month(null, $row->id);
        $row->month_earnings = $ci->coupon_sale_model->get_earnings_by_month(null, $row->id);
        $row->month_redeemed = $ci->coupon_redemption_model->get_views_by_month(null, $row->id);
        $row->month_average = $row->month_sales == 0 ? 0 : $row->month_earnings / $row->month_sales;

        $row->view_count = $ci->coupon_view_model->get_total_count($row->id);
        $row->sales_count = $ci->coupon_sale_model->get_total_count($row->id);
        $row->redemption_count = $ci->coupon_redemption_model->get_total_count($row->id);
        return $row;
    }

    private function check_current_user_coupons($row) {
        $ci = & get_instance();
        $ci->load->model('user_coupon_model', 'user_coupons');
        $ci->load->model('user_model', 'user');

        $user = $ci->home->get_current();
        if (!$user) {
            $row->user_owns_coupon = FALSE;
            return $row;
        } else {
            $status = $ci->user_coupons->user_owns_coupon($user->id, $row->id);
            if ($status) {
                $row->inactive = TRUE;
                $row->grab_link = "";
                $row->user_owns_coupon = TRUE;
            } else {
                $row->user_owns_coupon = FALSE;
            }
        }

        return $row;
    }

    public function featured_items() {
        $this->load->model('featured_coupon_model');
        $featured = $this->featured_coupon_model
                ->with('coupon')
                ->with('coupon_medias')
                ->limit(3, 0)
                ->get_all();

        if (empty($featured) || $featured == FALSE) {
            return FALSE;
        } else {
            $response = array();
            foreach ($featured as $value) {
                $row = $value->coupon;
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
                if ($this->is_merchant) {
                    $this->add_merchant_params($row);
                } else {
                    $row = $this->check_current_user_coupons($row);
                }

                $response[] = $this->process($row);
            }
            return $response;
        }
    }

    public function featured_item($id = 1) {
        $this->load->model(array('coupon_model', 'featured_coupon_model'));
        $couponz = $this->coupon_model
                ->with('coupon_medias')
                ->get_all();
        shuffle($couponz);
        $row = $couponz[rand(0, count($couponz))]; //$this->coupon_model->with('coupon_medias')->get($id);
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
            if ($this->is_merchant) {
                $this->add_merchant_params($row);
            } else {
                $row = $this->check_current_user_coupons($row);
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

    public function _get_sales_count($param) {
        return 1000;
    }

}

class Couponview {

    public function __get($param) {
        return 'N/A';
    }

}
