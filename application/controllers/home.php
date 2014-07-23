<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once APPPATH . 'presenters/category_presenter.php';
require_once APPPATH . 'presenters/coupon_presenter.php';

class Home extends MY_Controller {

    const USER_SESSION_VARIABLE = "user";

    public function __construct() {
        parent::__construct();
        $this->load->model('category_model', 'category');
        $this->load->model('coupon_model', 'coupons');
        $this->load->model('user_model', 'user');
        $this->load->library('pagination');
        $this->load->library('breadcrumbs');
        $this->load->library('qpagination');
    }

    public function index($category = 'all', $page = 0) {
        $limit = 20;
        $total = $this->_count_coupons($category);
        $base_url = base_url('index.php/categories/' . $category);

        //echo $category;
        //print_r($this->category->fetch_id_by_slug($category));
        $coupons = $this->_coupons($limit, $page, $this->category->fetch_id_by_slug($category));
        //print_r($coupons);

        $coupon_presenter = new Coupon_presenter($coupons);
        $this->data['title'] = 'All Projects';
        $this->data['categories'] = new Category_presenter($this->category->get_all(), base_url('index.php/categories'));
        $this->data['coupons'] = $coupon_presenter;
        $this->data['featured_item'] = $coupon_presenter->featured_item();
        $config = $this->_use_pagination($total, $limit, $base_url, 3);
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
    }

    public function login() {
        $this->view = FALSE;
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $redirect_url = $this->input->post('redirect');

        if ($email === FALSE || $password === FALSE) {
            $this->session->set_flashdata('login_error', 'Username or password is invalid');
        } else {
            $user = $this->user->login_email($email, $password);
            if (!$user) {
                $this->session->set_flashdata('login_error', 'Username/password combination doesnt belong to any accoutn');
            } else {
                $this->_create_session($user);
            }
        }
        redirect($redirect_url);
    }

    public function logout() {
        $this->session->unset_userdata(array(Home::USER_SESSION_VARIABLE => '', 'user_logged_in' => FALSE));
        redirect(base_url());
    }

    public function signup() {
        $this->view = FALSE;
        $password = $this->input->post('password');
        $re_password = $this->input->post('re_password');
        $redirect_url = $this->input->post('redirect');

        if ($password !== FALSE && $re_password !== FALSE && strcmp($password, $re_password) === 0) {
            $data = $this->input->post();
            unset($data['re_password']);
            unset($data['redirect']);
            $response = $this->user->insert($data);
            if (!$response) {
                $this->session->set_flashdata('login_error', 'Error Occured. ' . print_r($response, true));
            } else {
                $user = $this->user->get($response);
                $this->_create_session($user);
            }
        } else {
            $this->session->set_flashdata('login_error', 'Password Mismatch');
        }
        redirect($redirect_url);
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
        $base_url = base_url('index.php/search/');


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

    public function coupon($slug) {
        $coupon = $this->coupons->get_by_slug($slug);
        if (empty($coupon) || !is_object($coupon)) {
            show_404('home/error_page');
        } else {
            $coupon_presenter = new Coupon_presenter($coupon);
            $this->data['featured_item'] = $coupon_presenter->items();
        }
    }

    public function contact() {

    }

    public function about_us() {

    }

    public function how_it_works() {

    }

    public function help_faq() {

    }

    public function error_page() {

    }

    private function _coupons($limit, $page, $category = 'all') {
        if (strcmp($category, 'all') === 0) {
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

    private function _search_coupons($limit, $page, $query = null, $location = 'all') {
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
        if (strcmp('all', $category) === 0) {
            $count = $this->coupons->count_all();
        } else {
            $count = $this->coupons->count_by(array('category_id' => $this->category->fetch_id_by_slug($category)));
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

    private function _use_pagination($total, $per_page, $base_url, $segment = 3) {
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

    public function fb_login() {
        $this->view = FALSE;
        $fb_user = $this->input->post('fb_user');
        if ($fb_user === FALSE) {
            header('content-type: application/json');
            echo json_encode(array('error' => 'invalid fb user supplied'));
            exit();
        } else {
            $data = array();
            $data['first_name'] = $fb_user['first_name'];
            $data['last_name'] = $fb_user['last_name'];
            $data['email'] = $fb_user['email'];
            $data['oauth_enabled'] = 1;
            $data['fb_oauth_id'] = $fb_user['id'];
            $redirect_url = $fb_user['redirect_url'];
            //print_r($fb_user);
            //print_r($data);

            $state = $this->_process_fb_login($data);
            header('content-type: application/json');
            if (!$state) {
                echo json_encode(array('error' => 'Error Occured while loggining through facebook'));
            } else {
                echo json_encode(array('success' => true, 'redirect' => $redirect_url));
            }
            exit();
        }
    }

    private function _process_fb_login($data) {
        $is_new_user = $this->user->is_unique_email($data['email']);
        if ($is_new_user) {
            $id = $this->user->create_fb($data);
            if (!$id) {
                return FALSE;
            }
            $user = $this->user->login_fb($data['email'], $data['fb_oauth_id']);
        } else {
            $user = $this->user->is_fb_oauth_enabled($data['email']);
            if (!$user) {
                $user = $this->user->enable_fb_oauth($data['email'], $data);
            }
        }
        $this->_create_session($user);
        $this->session->set_userdata('fb_login', true);
        return TRUE;
    }

    private function _create_session($user) {
        if (@property_exists($user, 'coupons')) {
            $coups = $user->coupons;
        } else {
            $coups = array();
        }
        $data = array(Home::USER_SESSION_VARIABLE => array('id' => $user->id,
                'timestamp' => time(),
                'coupons' => $coups,
                'email' => $user->email
            ),
            'user_logged_in' => true);
        $this->session->set_userdata($data);
    }

    private function _is_logged_in($redirect = null) {
        $data = $this->session->userdata(Home::USER_SESSION_VARIABLE);
        if (!empty($data) && is_array($data) && is_numeric($data['id'])) {
            $status = TRUE;
        } else {
            $status = FALSE;
        }
        if (!$status || !$this->session->userdata('user_logged_in')) {
            if (is_null($redirect)) {
                $redirect = base_url('index.php/');
            }
            redirect($redirect);
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */