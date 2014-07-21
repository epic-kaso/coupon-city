<?php

class Presenter {

    protected $data;

    public function __construct($object) {
        //$name = strtolower(str_replace("_presenter", "", get_class($this)));
        $this->data = $object;
    }

    public function __get($attr) {
        if (isset(get_instance()->$attr)) {
            return get_instance()->$attr;
        }
    }

}
