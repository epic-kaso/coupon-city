<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require_once APPPATH . 'core/REST_Controller.php';

class Transactions extends REST_Controller {

    public function index_get($id = NULL) {
        $_id = 0;
        $coupons = FALSE;
        if (!$this->get('id') && $id === NULL) {
            $this->response(NULL, 400);
        }

        $_id = !$this->get('id') ? $id : $this->get('id');


        // $user = $this->some_model->getSomething( $this->get('id') );
        $users = array(
            1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
            2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array('hobbies' => array('fartings', 'bikes'))),
        );

        $user = @$users[$_id];
        $user[] = $this->get('coupons');
        if ($coupons) {
            $user['coupons'] = array('1' => 'Hello World', '2' => $this->get());
        }

        if ($user) {
            $this->response($user, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

    function index_post() {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');

        $this->response($message, 200); // 200 being the HTTP response code
    }

    function index_delete() {
        //$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');

        $this->response($message, 200); // 200 being the HTTP response code
    }

}
