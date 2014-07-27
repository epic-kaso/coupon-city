<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Wallet extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'user');
        $this->load->model('wallet_model', 'wallet');
        $this->load->model('wallet_transaction_model', 'transaction');
    }

    public function index() {
        show_404();
    }

    public function success() {
        $code = $this->input->get('code');
        $response = $this->transaction->authenticate_transaction_code($code);
        if (!$response) {
            $this->session->set_flashdata('error_msg', 'Invalid transaction code');
            redirect('/', 'refresh');
        } else {
            $r = $this->transaction->complete_transaction($response['id']);
            if ($r) {
                $this->wallet->credit_wallet($response['user_id'], $response['transaction_amount']);
                $this->session->set_flashdata('success_msg', 'Successfull Wallet transaction');
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid transaction code');
            }
            redirect('/', 'refresh');
        }
    }

    public function failure() {
        $this->session->set_flashdata('error_msg', 'Erronous Wallet transaction');
        redirect('/', 'refresh');
    }

    public function generate_transaction_code($amount) {
        $user = $this->user->get_current();
        if (!$user) {
            $response = array('status' => 'error');
        } else {
            $code = $this->transaction->generate_transaction_code($user->id, $amount);
            $response = array('status' => 'success', 'code' => $code);
        }

        header('content-type: application/json');
        echo json_encode($response);
    }

}
