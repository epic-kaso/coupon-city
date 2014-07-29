<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fileupload
 *
 * @author kaso
 */
class Fileupload {

    private $main_upload_path = './uploads/coupons';

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->helper('file');
    }

    public function do_upload() {
        $config['upload_path'] = $this->main_upload_path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '30000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['encrypt_name'] = TRUE;

        $this->CI->load->library('upload', $config);

        if (!$this->CI->upload->do_upload()) {
            $error = array('error' => $this->CI->upload->display_errors());
            json_output($error);
            //print_r($error);
        } else {
            $data = array('upload_data' => $this->CI->upload->data());
            //var_dump($data);
            //$this->CI->load->view('upload_success', $data);
            $response = $this->process_image($data['upload_data']['full_path']);
            if ($response) {
                $fullpath = $data['upload_data']['full_path'];
                $name = $data['upload_data']['file_name'];
                $path = 'uploads/coupons/' . $nameS;
                return array(
                    'url' => $path,
                    'full_path' => $fullpath,
                    'name' => $name);
            } else {
                return FALSE;
            }
            //print_r($data);
        }
    }

    public function process_image($path) {
        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 600;
        $config['quality'] = 70;

        $this->CI->load->library('image_lib', $config);

        if (!$this->CI->image_lib->resize()) {
            echo $this->CI->image_lib->display_errors();
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
