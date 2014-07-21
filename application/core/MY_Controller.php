<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller {

    public $view = TRUE;
    public $layout = TRUE;
    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->view = TRUE;
        $this->layout = TRUE;
    }

    public function _remap($method, $parameters) {
        if (method_exists($this, $method)) {
            call_user_func_array(array($this, $method), $parameters);
        } else {
            show_404();
        }
        $view = strtolower(get_class($this)) . '/' . $method;
        $view = (is_string($this->view) && !empty($this->view)) ? $this->view : $view;

        if ($this->view !== FALSE) {
            $this->data['error_msg'] = $this->session->flashdata('error_msg');
            $this->data['success_msg'] = $this->session->flashdata('success_msg');
            $this->data['yield'] = $this->load->view($view, $this->data, TRUE);

            if (is_string($this->layout) && !empty($this->layout)) {
                $layout = $this->layout;
            } elseif (file_exists(APPPATH . 'views/layouts/' .
                            strtolower(get_class($this)) . '.php')) {
                $layout = 'layouts/' .
                        strtolower(get_class($this));
            } else {
                $layout = 'layouts/application';
            }
            if ($this->layout) {
                $this->load->view($layout, $this->data);
            } else {
                echo $this->data['yield'];
            }
        }
    }

}
