<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Coupon extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('coupon_model', 'coupons');
        $this->load->model('coupon_media_model', 'coupon_media');
        $this->load->model('merchant_model', 'merchant');
    }

    public function index() {
        echo 'Test Frame work';
    }

    public function create() {
        if (!$this->_is_logged_in()) {
            $this->session->set_flashdata('error_msg', 'merchant Sign in required');
            redirect('merchant/index');
            exit();
        }
        $m = $this->session->userdata('merchant');
        $data = $this->input->post();
        $data['merchant_id'] = $m['id'];
        unset($data['images']);
        unset($data['brand_id']);
        unset($data['commision']);

        $id = $this->coupons->insert($data);
        if (is_bool($id) && $id == FALSE) {
            $this->session->set_flashdata('error_msg', 'Failed to Add Coupon');
            $response = array('error_msg' => 'Failed to Add Coupon');
        } else {
            $this->session->set_flashdata('success_msg', 'Successfully Added Coupon');
            $media = $this->_get_current_coupon_images();

            foreach ($media as $value) {
                $r = array('coupon_id' => $id,
                    'file_path' => $value['full_path'],
                    'media_url' => $value['url']);
                $this->coupon_media->insert($r);
                unset($value);
            }
            $response = array('success_msg' => 'Successfully Added Coupon');
        }
        header('content-type: application/json');
        echo json_encode($response);
        // redirect('merchant/add_coupon');
    }

    public function upload_image() {
        if (!$this->_is_logged_in()) {
            header('content-type: application/json');
            echo json_encode(array('error' => 'merchant not logged in'));
            //redirect('merchant/index');
            exit();
        }
        $this->load->library('fileupload');
        $response = $this->fileupload->do_upload();
        $images = $this->_add_to_session($response);

        if (!$response) {
            echo json_encode(array('error' => 'error occured'));
        } else {
            echo json_encode(
                    array(
                        'file_path' => $response['url'],
                        'images' => $images,
                        'file_name' => $response['name']
            ));
        }
    }

    public function verify_coupon() {

        if (!$this->_is_logged_in()) {
            header('content-type: application/json');
            echo json_encode(array('error' => 'merchant not logged in'));
            //redirect('merchant/index');
            exit();
        }
        $merchant = $this->merchant->get_current();
        $code = $this->input->post('coupon_code');
        if ($code !== FALSE) {
            $response = @$this->coupons->validate_user_coupon($code, $merchant->id);
            if ($response) {
                $result = array('is_valid' => $response, 'message' => 'Successfully Validated.');
            } else {
                $result = array('is_valid' => $response, 'message' => 'This Coupon Code is Invalid');
            }
        } else {
            $result = array('is_valid' => false, 'message' => 'This Coupon Code is Invalid');
        }

        header('content-type: application/json');
        echo json_encode($result);
    }

    private function _is_logged_in() {
        $data = $this->session->userdata("merchant");
        if (!empty($data) && is_array($data) && is_numeric($data['id'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function _add_to_session($image) {
        $data = $this->session->userdata('merchant-image');
        if (empty($data)) {
            $data = array();
        }
        $data[time()] = $image;
        $this->session->set_userdata('merchant-image', $data);
        return array_keys($data);
    }

    private function _get_current_coupon_images() {
        $data = $this->session->userdata('merchant-image');
        return $data;
    }

}
