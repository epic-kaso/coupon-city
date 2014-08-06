<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once APPPATH . 'libraries/Mobile_Detect.php';

class MY_Controller extends CI_Controller {

    public $view = TRUE;
    public $layout = TRUE;
    public $data = array();
    public $mobile_detect = FALSE;

    public function __construct() {
        parent::__construct();
        $this->view = TRUE;
        $this->layout = TRUE;
        $this->mobile_detect = new Mobile_Detect;
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
