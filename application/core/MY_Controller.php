<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once APPPATH . 'libraries/Mobile_Detect.php';
require_once APPPATH . 'presenters/category_presenter.php';
require_once APPPATH . 'presenters/coupon_presenter.php';
require_once APPPATH . 'presenters/merchant_presenter.php';
require_once APPPATH . 'presenters/user_presenter.php';
require_once APPPATH . 'libraries/recaptchalib.php';

class MY_Controller extends CI_Controller {

    public $view = TRUE;
    public $layout = TRUE;
    public $data = array();
    public $mobile_detect = FALSE;

    const ADMIN = "akason47@live.com";

    protected $privatekey = "6LfXEfgSAAAAAMjCvQ1uQ0EMHz9fVpNh5fkqU0E5";
    protected $user_session_variable = 'user';
    protected $salt = 'user_token_salt';

    public function __construct() {
        parent::__construct();
        $this->view = TRUE;
        $this->layout = TRUE;
        $this->mobile_detect = new Mobile_Detect;
        $this->load->model('category_model', 'category');
        $this->load->model('coupon_model', 'coupons');

        $this->load->library('pagination');
        $this->load->library('breadcrumbs');
        $this->load->library('qpagination');
        $this->load->helper('file');
    }

    public function logout($redirect = null) {
        $this->session->sess_destroy();
        if (is_null($redirect)) {
            redirect(base_url());
        } else {
            redirect($redirect);
        }
    }

    protected function _is_logged_in($redirect = null) {
        $data = $this->session->userdata($this->user_session_variable);
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

    protected function get_current() {
        $value = strtolower(get_class($this));
        return $this->$value->get_current() || FALSE;
    }

    protected function _check_captcha() {
        $resp = recaptcha_check_answer($this->privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) {
            // What happens when the CAPTCHA was entered incorrectly
            return $resp->error;
        } else {
            return true;
        }
    }

    protected function _generate_activation_code($email) {
        //$salt = 'merchant_couponcity';
        return crypt($this->salt . $email . time());
    }

    protected function _is_token_valid($user) {
        $updated = $user->updated_at;
        $date = human_to_unix($updated);
        $expire = (15 * 60) + $date;

        if (date('U') > $expire) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    protected function _send_mail($email, $name, $subject, $type = 'contact_us') {

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

    protected function _log_request($name, $email, $phone, $message) {
        $this->load->library('mailer');
        $this->view = FALSE;
        return $this->mailer->send_mail(
                        array(
                    "name" => 'Couponcity App',
                    'email' => 'no-reply@couponcity.com.ng'
                        ), self::ADMIN, 'You have received a new inquiry from ' . $name . ' - ' . $email, $message);
    }

    protected function _get_crumbs() {
        $uri = uri_string();
        $uris = explode('/', $uri);

        $v = "";
        foreach ($uris as $value) {
            $v .= '/' . $value;
            $this->breadcrumbs->push($value, base_url($v));
        }

        return $this->breadcrumbs->show();
    }

    protected function _use_pagination($total, $per_page, $base_url, $segment = 3) {
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

    public function _remap($method, $parameters) {
        if (method_exists($this, $method)) {
            call_user_func_array(array($this, $method), $parameters);
        } else {
            show_404();
        }
        if (!$this->mobile_detect || !$this->mobile_detect->isMobile()) {
            $view = strtolower(get_class($this)) . '/' . $method;
        } else {
            $view = strtolower(get_class($this)) . '/mobile/' . $method;
        }
        $view = (is_string($this->view) && !empty($this->view)) ? $this->view : $view;

        if ($this->view !== FALSE) {
            $this->data['error_msg'] = $this->session->flashdata('login_error') .
                    $this->session->flashdata('error_msg');
            $this->data['success_msg'] = $this->session->flashdata('success_msg');
            $this->data['yield'] = $this->load->view($view, $this->data, TRUE);

            $layout_ext = $this->mobile_detect->isMobile() ? '-mobile.php' : '.php';
            $layout_end = $this->mobile_detect->isMobile() ? '-mobile' : '';

            if (is_string($this->layout) && !empty($this->layout)) {
                $layout = $this->layout;
            } elseif (file_exists(APPPATH . 'views/layouts/' .
                            strtolower(get_class($this)) . $layout_ext)) {
                $layout = 'layouts/' .
                        strtolower(get_class($this)) . $layout_end;
            } else {
                $layout = 'layouts/application' . $layout_end;
            }
            if ($this->layout) {
                $this->load->view($layout, $this->data);
            } else {
                echo $this->data['yield'];
            }
        }
    }

}
