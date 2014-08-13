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

    public function upload_batch($merchant_id, $file_name_array) {
        $response = array();
        foreach ($file_name_array as $value) {
            $response[$value] = $this->do_upload("{$this->main_upload_path}/{$merchant_id}", FALSE, $value);
        }

        return $response;
    }

    public function do_upload($path = null, $output_json = TRUE, $file_name = FALSE) {
        if (!is_null($path) && !file_exists($path)) {
            mkdir($path, 0777, TRUE);
        }
        $config['upload_path'] = is_null($path) ? $this->main_upload_path : $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '30000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['encrypt_name'] = TRUE;

        $this->CI->load->library('upload', $config);
        $do_upload = ($file_name === FALSE) ? $this->CI->upload->do_upload() : $this->CI->upload->do_upload($file_name);

        if (!$do_upload) {
            $error = array('error' => $this->CI->upload->display_errors());
            if ($output_json) {
                json_output($error);
                //print_r($error);
            } else {
                return $error;
            }
            //
        } else {
            $data = array('upload_data' => $this->CI->upload->data());
            //var_dump($data);
            //$this->CI->load->view('upload_success', $data);
            if (isset($path)) {
                $response = $this->process_image_small($data['upload_data']['full_path']);
            } else {
                $response = $this->process_image($data['upload_data']['full_path']);
            }
            if ($response) {
                $fullpath = $data['upload_data']['full_path'];
                $name = $data['upload_data']['file_name'];
                $base = isset($path) ? str_replace('.', '', $path) : str_replace('.', '', $this->main_upload_path);
                $path = "$base$name";
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
        $config['maintain_ratio'] = TRUE;
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

    public function process_image_small($path) {
        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = 200;
        $config['height'] = 200;
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
