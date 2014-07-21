<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once APPPATH . 'presenters/category_presenter.php';
require_once APPPATH . 'presenters/coupon_presenter.php';

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('category_model', 'category');
        $this->load->model('coupon_model', 'coupons');
        $this->load->library('pagination');
        $this->load->library('qpagination');
    }

    public function index($page = 0, $category = 'all') {
        $limit = 20;
        $total = $this->_count_coupons($category);
        $base_url = base_url('coupons/');

        $coupons = $this->_coupons($limit, $page, $category);
        $coupon_presenter = new Coupon_presenter($coupons);
        $this->data['title'] = 'All Projects';
        $this->data['categories'] = new Category_presenter($this->category->get_all(), site_url('home/index/0/'));
        $this->data['coupons'] = $coupon_presenter;
        $this->data['featured_item'] = $coupon_presenter->featured_item();
        $config = $this->_use_pagination($total, $limit, $base_url, 2);
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
    }

    public function search($page = 0, $location = 'all', $search = 'helloworld') {
        $search = urlencode($search);
        $location = urlencode($location);
        if ($this->input->get('q') !== FALSE) {
            $search = $this->input->get('q');
        }
        if ($this->input->get('l') !== FALSE) {
            $location = $this->input->get('l');
        }
        $limit = 20;
        $coupons = $this->_search_coupons($limit, $page, $search, $location);
        $total = $this->_search_count_coupons($search, $location);
        $base_url = base_url('search/');


        $coupon_presenter = new Coupon_presenter($coupons);
        $config = $this->_use_pagination($total, $limit, $base_url, 2);
        $config['cur_page'] = $page;
        $config['my_suffix'] = '?' . http_build_query(array('q' => $search, 'l' => $location));
        $this->qpagination->initialize($config);

        $search_result = new stdClass();
        $search_result->count = $total;
        $search_result->coupons = $coupon_presenter;

        $search_query = new stdClass();
        $search_query->query = $search;
        $search_query->location = $location;

        $this->data['search_result'] = $search_result;
        $this->data['search_query'] = $search_query;
        $this->data['coupons'] = $coupon_presenter;


        $this->data['links'] = $this->qpagination->create_links();
    }

    public function _coupons($limit, $page, $category = 'all') {
        if (!is_numeric($category)) {
            $coupons = $this->coupons
                    ->limit($limit, $page * $limit)
                    ->get_all();
        } else {
            $coupons = $this->coupons
                    ->limit($limit, $page * $limit)
                    ->get_many_by('category_id', $category);
        }

        return $coupons;
    }

    public function _search_coupons($limit, $page, $query = null, $location = 'all') {
        if ($query === null) {
            return;
        }
        if (strcmp('all', $location) !== 0) {
            $coupons = $this->coupons
                    ->limit($limit, $page * $limit)
                    ->search($query, null, true);
        } else {
            $coupons = $this->coupons
                    ->limit($limit, $page * $limit)
                    ->search($query, $location, true);
        }

        return $coupons;
    }

    private function _count_coupons($category = 'all') {
        if (!is_numeric($category)) {
            $count = $this->coupons->count_all();
        } else {
            $count = $this->coupons->count_by(array('category_id' => $category));
        }
        return $count;
    }

    private function _search_count_coupons($query = null, $location = 'all') {

        if ($query === null) {
            return 0;
        }
        if (strcmp('all', $location) !== 0) {
            $count = $this->coupons
                    ->count_search($query);
        } else {
            $count = $this->coupons
                    ->count_search($query, $location);
        }
        return $count;
    }

    public function _use_pagination($total, $per_page, $base_url, $segment = 3) {
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total;
        $config['uri_segment'] = $segment;
        $config['per_page'] = $per_page;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        return $config;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */