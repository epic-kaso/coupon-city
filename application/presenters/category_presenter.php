<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once APPPATH . 'presenters/presenter.php';

class Category_presenter extends Presenter {

    public $base_url = '';

    public function __construct($object, $base_url) {
        parent::__construct($object);
        $this->base_url = $base_url;
    }

    public function items() {
        if (empty($this->data)) {
            $row = new stdClass();
            $row->name = 'No Category Available';
            return array($row);
        } else {
            return $this->process($this->data);
        }
    }

    private function process($data) {
        foreach ($data as $value) {
            $value->link = $this->base_url . '/' . $value->id;
            $value->active = $this->is_active($value->id);
        }
        return $data;
    }

    private function is_active($id) {
        return $this->uri->segment(4) == $id;
    }

}
