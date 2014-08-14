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
        $data = $this->input->post('coupon');
        //print_r($data);
        $coupon_medias = array();
        for ($i = 'a'; $i < 'f'; $i++) {
            $coupon_medias[] = "coupon_media_{$i}";
        }
        $id = $this->add_coupon_to_db($data);

        $res = $this->do_upload($coupon_medias);

        //print_r($res);

        if (is_bool($id) && $id == FALSE) {
            $this->session->set_flashdata('error_msg', 'Failed to Add Coupon');
            // $response = array('error_msg' => 'Failed to Add Coupon');
        } else {
            $this->add_image_to_coupon($res, $id);
            $this->session->set_flashdata('success_msg', 'Successfully Added Coupon');
            //$tsuccess_msg' => 'Successfully Added Coupon');
        }
        //print_r($response);
        redirect(base_url('merchant/my-coupons'));
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

    private function add_image_to_coupon($response, $coupon_id) {
        $report = array();
        foreach ($response as $value) {
            if (is_array($response) && !array_key_exists('error', $value)) {
                $r = array('coupon_id' => $coupon_id,
                    'file_path' => $value['full_path'],
                    'media_url' => $value['url']);
                $report[] = $this->coupon_media->insert($r);
                //print_r($r);
            }
        }
        return $report;
    }

    private function add_coupon_to_db($data) {
        //$data['merchant_id'] = $this->merchant->get_current()->id;
        $is_advanced_pricing = isset($data['pricing_type']) && $data['pricing_type'] == 'advanced' ? TRUE : FALSE;
        $coupon_data = array(
            'name' => $data['name'],
            'summary' => $data['summary'],
            'description' => $data['description'],
            'tag_line' => $data['tag_line'],
            'location' => $data['location'],
            'category_id' => $data['category'],
            'merchant_id' => $this->merchant->get_current()->id,
            'quantity' => $data['quantity'],
            'start_date' => Carbon::parse($data['start_date']),
            'end_date' => Carbon::parse($data['end_date']),
            'old_price' => $data['old_price']
        );

        /*
         * advanced pricing spec
         * array=>'advanced_pricing'
         *  array=>'first'
         *          array=>'count','value'
         *                  'price','value'
         *                  'discount',value
         * array=>'second'
         *          array=>'count','value'
         *                 'price','value'
         *                 'discount',value
         * array=>'third'
         *          array=>'count','value'
         *                 'price','value'
         *                 'discount',value
         *
         */
        if ($is_advanced_pricing) {
            $coupon_data['is_advanced_pricing'] = TRUE;
            $coupon_data['advanced_pricing'] = array(
                'first' => array(
                    'price' => $data['pricing_advanced'][0]['new_price'],
                    'count' => $data['pricing_advanced'][0]['customer_count'],
                    'discount' => $data['pricing_advanced'][0]['discount']
                )
            );
            if (isset($data['pricing_advanced'][1]['new_price']) && !empty($data['pricing_advanced'][1]['new_price'])) {
                $coupon_data['advanced_pricing']['second'] = array(
                    'price' => $data['pricing_advanced'][1]['new_price'],
                    'count' => $data['pricing_advanced'][1]['customer_count'],
                    'discount' => $data['pricing_advanced'][1]['discount']
                );

                if (isset($data['pricing_advanced'][2]['new_price']) && !empty($data['pricing_advanced'][2]['new_price'])) {
                    $coupon_data['advanced_pricing']['third'] = array(
                        'price' => $data['pricing_advanced'][2]['new_price'],
                        'count' => $data['pricing_advanced'][2]['customer_count'],
                        'discount' => $data['pricing_advanced'][2]['discount']
                    );
                }
            }
        } else {
            $coupon_data['new_price'] = $data['pricing_basic']['new_price'];
            $coupon_data['discount'] = $data['pricing_basic']['discount'];
        }


        $id = $this->coupons->insert($coupon_data);
        return $id;
    }

    private function do_upload($file_name_array) {
        if (!$this->_is_logged_in()) {
            redirect(base_url('merchant/login'));
            exit();
        }
        $this->load->library('fileupload');
        $merchant_id = $this->merchant->get_current()->id;
        $response = $this->fileupload->upload_batch($merchant_id, $file_name_array);
        return $response;
    }

}
