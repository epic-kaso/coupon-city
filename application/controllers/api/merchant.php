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

class Merchant extends REST_Controller {
    /*
     * $this->load->model('post_model', 'post');

      $this->post->get_all();

      $this->post->get(1);
      $this->post->get_by('title', 'Pigs CAN Fly!');
      $this->post->get_many_by('status', 'open');

      $this->post->insert(array(
      'status' => 'open',
      'title' => "I'm too sexy for my shirt"
      ));

      $this->post->update(1, array( 'status' => 'closed' ));

      $this->post->delete(1);

     */

    public function __construct() {
        parent::__construct();
        $this->load->model('merchant_model', 'merchant');
    }

    public function index_get($id = NULL) {
        if (!$this->get('id') && $id === NULL) {
            $merchant = $this->merchant
                    ->with('merchant_image')
                    ->with('merchant_information')
                    ->with('coupons')
                    ->get_all();
            $this->response($merchant, 200); // 200 being the HTTP response code
        } else {
            $_id = !$this->get('id') ? $id : $this->get('id');
            $merchant = $this->merchant
                    ->with('merchant_image')
                    ->with('merchant_information')
                    ->with('coupons')
                    ->get($_id);
            $this->response($merchant, 200); // 200 being the HTTP response code
        }
    }

    function index_post($id = NULL) {
        if (!$this->post('id') && $id === NULL) {
            if (!$this->post('email')) {
                $this->response(NULL, 400);
            }
            $data = $this->post();
            $message = $this->merchant->insert($data);
        } else {
            $_id = !$this->post('id') ? $id : $this->post('id');
            $message = $this->merchant->update($_id, $this->post());
        }
        $this->response(array('status' => $message), 200); // 200 being the HTTP response code
    }

    function index_delete($id) {
        $_id = !$this->get('id') ? $id : $this->get('id');
        //$this->some_model->deletesomething( $this->get('id') );
        $message = $this->merchant->delete($_id);
        $this->response(array('status' => $message), 200); // 200 being the HTTP response code
    }

}
