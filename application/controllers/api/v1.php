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

class V1 extends REST_Controller {
    /*
     * Merchant related Apis
     *
     */

    public function merchant_get($id = '') {
        $_id = !$this->get('id') ? $id : $this->get('id');

        $response = $this->curl->simple_get('api/merchant/index/' . $_id);
        header('content-type: application/json');
        echo $response;
    }

    public function merchant_post() {
        if (!$this->post('email')) {
            $this->response(NULL, 400);
        }
        $response = $this->curl->simple_post('api/merchant/index', $this->post());
        $this->response($response, 200);
    }

    public function merchant_put($id = NULL) {
        if (!$this->put('id') && $id === NULL) {
            $this->response(NULL, 400);
        }
        $_id = !$this->put('id') ? $id : $this->put('id');
        $response = $this->curl->simple_post('api/merchant/index/' . $_id, $this->post());
        $this->response($response, 200);
    }

    public function merchant_delete($id = NULL) {
        if (!$this->delete('id') && $id === NULL) {
            $this->response(NULL, 400);
        }
        $_id = !$this->delete('id') ? $id : $this->delete('id');
        $response = $this->curl->simple_delete('api/merchant/index/' . $_id, $this->delete());
        $this->response($response, 200);
    }

}
