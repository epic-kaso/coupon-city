<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of merchant_presenter
 *
 * @author kaso
 */
require_once APPPATH . 'presenters/presenter.php';

class Merchant_presenter extends Presenter {

    public function __construct($object) {
        $object->address = $this->create_address($object);
        parent::__construct($object);
    }

    public function __get($attr) {
        if (property_exists($this->data, $attr) && !empty($this->data->$attr)) {
            return $this->data->$attr;
        } else {
            return '';
        }
    }

    private function create_address($row) {
        $address = "$row->address_one $row->city,$row->state";
        return $address;
    }

}
