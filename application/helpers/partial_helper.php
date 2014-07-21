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
