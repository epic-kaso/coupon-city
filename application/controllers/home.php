<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once APPPATH . 'presenters/category_presenter.php';
require_once APPPATH . 'presenters/coupon_presenter.php';
require_once APPPATH . 'presenters/user_presenter.php';
require_once APPPATH . 'libraries/recaptchalib.php';

class Home extends MY_Controller {

    const USER_SESSION_VARIABLE = "user";
    const ADMIN = "akason47@live.com";

    private $privatekey = "6LfXEfgSAAAAAMjCvQ1uQ0EMHz9fVpNh5fkqU0E5";

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
        $base_url = base_url('categories/' . $category);
        $coupons = $this->_coupons($limit, $page, $this->category->fetch_id_by_slug($category));
        $coupon_presenter = new Coupon_presenter($coupons);

        $this->data['title'] = 'All Projects';
        $this->data['categories'] = new Category_presenter($this->category->get_all(), base_url('categories'));
        $this->data['coupons'] = $coupon_presenter;
        $this->data['featured_item'] = $coupon_presenter->featured_item();

        $config = $this->_use_pagination($total, $limit, $base_url, 3);
        $config['cur_page'] = $page;

        $this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $this->data['user'] = $this->user->get_current();
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
                $this->session->set_flashdata('login_error', 'Username/Password combination doesn\'t belong to any account.');
            }
        }
        redirect($redirect_url);
    }

    public function logout() {
        //$this->session->unset_userdata(array(Home::USER_SESSION_VARIABLE => ''));
        $this->session->sess_destroy();
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
                $response = $this->_send_mail($data['email'], array('username' => $data['email'], 'password' => $data['password']), 'Welcome to couponcity', 'welcome');
                $this->user->login_email($data['email'], $password);
            }
        } else {
            $this->session->set_flashdata('login_error', 'Password mis-match');
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
        $this->data['user'] = $this->user->get_current();
        $this->data['links'] = $this->qpagination->create_links();
        $this->data['breadcrumbs'] = $this->_get_crumbs();
    }

    public function coupon($slug) {
        $this->load->model('coupon_view_model', 'coupon_view');

        $coupon = $this->coupons->get_by_slug($slug);
        $this->data['user'] = $this->user->get_current();
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        if (!$coupon) {
            show_404('home/error_page');
        } else {
            $this->coupon_view->increase_view($coupon->id);
            $coupon_presenter = new Coupon_presenter($coupon, FALSE);
            $this->data['item'] = $coupon_presenter->item();
        }
    }

    public function grab_coupon($slug) {
        $this->view = FALSE;

        $this->_is_logged_in();

        $user = $this->user->get_current();
        $coupon = $this->coupons->get_by_slug($slug);
        $response = $this->coupons->grab_coupon($coupon->id, $user->id);

        if (!$response || (is_array($response) && array_key_exists('error', $response))) {
            // echo 'Couldn\'t grab coupon!.Check that you have money in your wallet ';
            $this->session->set_flashdata('error_msg', 'Couldn\'t grab coupon!.' . $response['error']);
            redirect(base_url('coupon/' . $slug), 'refresh');
            // return;
        } else {
            //echo 'success : ' . $response;
            $this->session->set_flashdata('success_msg', 'Grabbed successfully. Coupon Code: ' . $response);
            redirect(base_url('coupon/' . $slug), 'refresh');
            // return;
        }
    }

    public function contact() {
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $this->data['user'] = $this->user->get_current();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $cap = $this->_check_captcha();
            if ($cap) {
                if ($name !== FALSE && $email !== FALSE && $subject !== FALSE && $message !== FALSE) {
                    $response = $this->_send_mail($email, $name, 'RE: ' . $subject);
                    $r = $this->_log_request($name, $email, $phone, $message);
                    if ($response) {
                        $this->session->set_flashdata('success_msg', 'your request was sent succesfully');
                    } else {
                        $this->session->set_flashdata('error_msg', 'We couldn\'t complete your request at this time');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'You Missed some needed parameters in your request');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid Captcha entered');
            }

            redirect(base_url('contact'));
        }
    }

    public function about_us() {
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $this->data['user'] = $this->user->get_current();
    }

    public function how_it_works() {
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $this->data['user'] = $this->user->get_current();
    }

    public function help_faq() {
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $this->data['user'] = $this->user->get_current();
    }

    public function coupon_not_found() {
        $this->view = 'home/error_page';
        $this->data['code'] = 'Coupon Not Found';
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $this->data['user'] = $this->user->get_current();
    }

    public function error_page($code = 404) {
        $this->data['code'] = $code;
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $this->data['user'] = $this->user->get_current();
    }

    public function settings() {
        $this->_is_logged_in();
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $user = $this->user->get_current();
        $this->data['profile'] = new User_presenter($user);
        $this->data['user'] = $user;
        $this->data['logged_in'] = $this->session->userdata('logged_in');
    }

    public function my_coupons($category = 'all', $page = 0) {
        $this->_is_logged_in();
        $user = $this->user->get_current();
        $error = !$this->session->flashdata('error_msg') ? 'Please Login or Create an Account' :
                $this->session->flashdata('error_msg');
        $this->session->flashdata('error_msg', $error);
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $this->data['user'] = $user;

        $limit = 20;
        $total = $this->_count_my_coupons($category);
        $base_url = base_url('my-coupons/');

        $coupons = $this->_my_coupons($limit, $page, $category);
        $coupon_presenter = new Coupon_presenter($coupons);
        $this->data['categories'] = new Category_presenter($this->category->get_all(), base_url('my-coupons/'));
        $this->data['coupons'] = $coupon_presenter;
        $config = $this->_use_pagination($total, $limit, $base_url);
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
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

    public function profile() {
        $this->_is_logged_in();
        $user = $this->user->get_current();
        $this->data['profile'] = new User_presenter($user);
        $this->data['user'] = $user;
        $this->data['logged_in'] = $this->session->userdata('logged_in');
        $this->data['breadcrumbs'] = $this->_get_crumbs();
    }

    public function edit_profile() {
        $this->_is_logged_in();
        $user = $this->user->get_current();
        $this->data['profile'] = $this->user->profile_info($user);
        $this->data['user'] = $user;
        $this->data['breadcrumbs'] = $this->_get_crumbs();
        $this->data['logged_in'] = $this->session->userdata('logged_in');
        $this->load->helper('url');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->view = TRUE;
        } else {
            $this->view = FALSE;
            $this->user->update($user->id, $this->input->post(), TRUE);
            $this->session->set_flashdata('success_msg', 'Profile Saved!');
            redirect(base_url('profile'));
        }
    }

    public function change_password() {
        $this->view = FALSE;
        $user = $this->user->get_current();
        $password = trim($this->input->post('password'));
        $repassword = trim($this->input->post('re_password'));
        $redirect_url = $this->input->post('redirect');

        if ($password !== FALSE && $repassword !== FALSE) {
            $this->_process_change_password($password, $repassword, $user, $redirect_url);
        } else {
            $this->session->set_flashdata('error_msg', 'Password Fields cant be empty');
            redirect($redirect_url);
        }
    }

    private function _coupons($limit, $page, $category_id = 'all') {
        if (strcmp($category_id, 'all') === 0) {
            $coupons = $this->coupons
                    ->limit($limit, $page * $limit)
                    ->with('coupon_medias')
                    ->get_all();
        } else {
            $coupons = $this->coupons
                    ->limit($limit, $page * $limit)
                    ->with('coupon_medias')
                    ->get_many_by('category_id', $category_id);
        }

        return $coupons;
    }

    private function _my_coupons($limit, $page, $category = 'all') {
        $user = $this->user->get_current();
        $this->load->model('user_coupon_model', 'user_coupons');

        if (strcmp('all', $category) === 0) {
            $coupons = $this->user_coupons->get_coupons_for($user->id);
        } else {
            $coupons = $this->user_coupons->get_coupons_for($user->id, $this->category->fetch_id_by_slug($category));
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

    private function _count_my_coupons($category = 'all') {
        $user = $this->user->get_current();
        $this->load->model('user_coupon_model', 'user_coupons');

        if (strcmp('all', $category) === 0) {
            $count = count($this->user_coupons->get_coupons_for($user->id));
        } else {
            $count = count($this->user_coupons->get_coupons_for($user->id, $this->category->fetch_id_by_slug($category)));
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

    private function _process_fb_login($data) {
        $is_new_user = $this->user->is_unique_email($data['email']);
        if ($is_new_user) {
            $id = $this->user->create_fb($data);
            $this->_send_mail($data['email'], array('username' => $data['email'], 'password' => '* not available *'), 'Welcome to couponcity', 'welcome');

            if (!$id) {
                return FALSE;
            }
            $user = $this->user->login_fb($data['email'], $data['fb_oauth_id']);
        } else {
            $user = $this->user->is_fb_oauth_enabled($data['email']);
            if (!$user) {
                $user = $this->user->enable_fb_oauth($data['email'], $data);
            }
            $this->user->login_fb($data['email'], $data['fb_oauth_id']);
        }
        $this->session->set_userdata('fb_login', true);
        return TRUE;
    }

    private function _is_logged_in($redirect = null) {
        $data = $this->session->userdata(Home::USER_SESSION_VARIABLE);
        if (!empty($data) && is_array($data) && is_numeric($data['id'])) {
            $status = TRUE;
        } else {
            $status = FALSE;
        }
        if (!$status) {
            $this->session->set_flashdata('login_error', 'Oww, Please you need to login/signup to do that');
            if (is_null($redirect)) {
                $redirect = base_url();
            }
            redirect($redirect);
        } else {
            return $status;
        }
    }

    private function _get_crumbs() {
        $uri = uri_string();
        $uris = explode('/', $uri);

        $v = "";
        foreach ($uris as $value) {
            $v .= '/' . $value;
            $this->breadcrumbs->push($value, base_url($v));
        }

        $this->breadcrumbs->unshift('Home', base_url());

        return $this->breadcrumbs->show();
    }

    private function _process_change_password($password, $repassword, $user, $redirect_url) {
        if (strcmp($password, $repassword) == 0) {
            if (sha1($password) === $user->password) {
                $this->session->set_flashdata('error_msg', 'You can\'t change from same password to same!');
                redirect($redirect_url);
            } else {
                $this->merchant->update($user->id, array('password' => sha1($password)));
                $this->session->set_flashdata('success_msg', 'Password Changed!');
                redirect($redirect_url);
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Password Fields Must Match');
            redirect($redirect_url);
        }
    }

    private function _send_mail($email, $name, $subject, $type = 'contact_us') {

        $this->load->library('mailer');
        $this->view = FALSE;
        if (is_array($name)) {
            $message = $this->load->view('email/' . $type, $name, TRUE);
        } else {
            $message = $this->load->view('email/' . $type, array('name' => $name), TRUE);
        }
        return $this->mailer->send_mail(
                        array(
                    "name" => 'Couponcity',
                    'email' => 'no-reply@couponcity.com.ng'
                        ), $email, $subject, $message);
    }

    private function _log_request($name, $email, $phone, $message) {
        $this->load->library('mailer');
        $this->view = FALSE;
        return $this->mailer->send_mail(
                        array(
                    "name" => 'Couponcity App',
                    'email' => 'no-reply@couponcity.com.ng'
                        ), self::ADMIN, 'You have received a new inquiry from ' . $name . ' - ' . $email, $message);
    }

    private function _check_captcha() {
        $resp = recaptcha_check_answer($this->privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) {
            // What happens when the CAPTCHA was entered incorrectly
            return $resp->error;
        } else {
            return true;
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */