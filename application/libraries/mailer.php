<?php

/**
 * Description of Mailer
 *
 * @author kaso
 */
class Mailer {
    /*
     * from could be an array with keys name: email:
     * or simply a string email:
     *
     */

    public function send_mail($from = FALSE, $to = FALSE, $subject = FALSE, $message = FALSE, $file = FALSE) {
        $ci = get_instance();
        $ci->load->library('email');
        $ci->config->load('email');
        $ci->load->helper('email');
        $password = $ci->config->item('password');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "kasoprecede47@gmail.com";
        $config['smtp_pass'] = $password;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        if (is_array($from)) {
            if (valid_email($from['email'])) {
                $ci->email->from($from['email'], $from['name']);
            } else {
                return FALSE;
            }
        } else {
            if (valid_email($from)) {
                $ci->email->from($from, $from);
            } else {
                return FALSE;
            }
        }
        if (!$to) {
            $list = array('akason47@live.com');
        } else {
            $list = is_array($to) ? $to : array($to);
        }
        $ci->email->to($list);
        $this->email->reply_to('kasoprecede47@gmail.com', 'Explendid Videos');
        $ci->email->subject(is_string($subject) ? $subject : date(DATE_ISO8601));
        $ci->email->message(is_string($message) ? $message : date(DATE_ISO8601));


        if ($file) {
            $this->email->attach($file);
        }
        return $ci->email->send();
    }

    public function __get($attr) {
        if (isset(get_instance()->$attr)) {
            return get_instance()->$attr;
        }
    }

}
