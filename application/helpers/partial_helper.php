<?php

if (!function_exists('partial')) {

    function partial($name, $data, $loop = FALSE) {
        $output = "";
        if ($loop && is_array($data)) {
            foreach ($data as $row) {
                $output .= get_instance()->load->view($name, array('row' => $row), TRUE);
            }
        } else {
            $output = get_instance()->load->view($name, $data, TRUE);
        }
        return $output;
    }

}


if (!function_exists('store_temp_url')) {

    function store_temp_url($url) {
        $ci = & get_instance();
        $ci->session->set_userdata('temp_url', $url);
    }

}

if (!function_exists('get_temp_url')) {

    function get_temp_url() {
        $ci = & get_instance();
        $v = $ci->session->userdata('temp_url');
        if (!$v) {
            return base_url();
        } else {
            return $v;
        }
    }

}