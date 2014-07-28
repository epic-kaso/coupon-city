<?php

/**
 * Description of Mailer
 *
 * @author kaso
 */
class Mailer {

    public function __construct() {
        $this->config->load('email', TRUE);
        $this->load->library('email');
    }

    public function send_mail($from, $to, $subject, $message, $is_html = FALSE, $file = FALSE) {
        $response = array();
        $email_config = $this->config->item('email');
        $email_config['mailtype'] = ($is_html) ? 'html' : 'text';
        $this->email->initialize($email_config);
        $this->email->clear();
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject($subject);
        $this->email->message($message);

        if (!$file) {
            @$this->email->attach($file);
        }
        $response[$to] = @$this->email->send() ? 'success' : 'failure';
        //echo $this->email->print_debugger();
        return $response;
    }

    public function send_batch($from, $to, $subject, $message, $is_html = FALSE, $file = FALSE) {
        $email_config = $this->config->item('email');
        $email_config['mailtype'] = ($is_html) ? 'html' : 'text';
        $this->email->initialize($email_config);
        $response = array();
        print_r($to);
        if (is_array($to) && count($to) > 1) {
            foreach ($to as $value) {
                $this->email->clear();
                $this->email->from($from['email'], $from['name']);
                $this->email->to($value);
                //$this->email->cc('another@another-example.com');
                //$this->email->bcc('them@their-example.com');

                $this->email->subject($subject);
                $this->email->message($message);

                if (!$file) {
                    @$this->email->attach($file);
                }
                $response[$value] = @$this->email->send() ? 'success' : 'failure';
                //echo $this->email->print_debugger();
            }

            return $response;
        } else {
            return $this->send_mail($from, $to, $subject, $message, $is_html, $file);
        }
    }

    public function __get($attr) {
        if (isset(get_instance()->$attr)) {
            return get_instance()->$attr;
        }
    }

}
