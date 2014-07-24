<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Wallet extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        show_404();
    }

    public function success($user_id, $transaction_id) {
        $this->session->set_flashdata('success_msg', 'Successfull Wallet transaction');
        redirect('/', 'refresh');
    }

    public function failure($user_id, $transaction_id) {
        $this->session->set_flashdata('error_msg', 'Erronous Wallet transaction');
        redirect('/', 'refresh');
    }

}
