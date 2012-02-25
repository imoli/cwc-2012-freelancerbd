<?php

/**
 * Provides the data of the outgoing HTTP response
 */
class Response {

    const OK = 200;
    const CREATED = 201;
    const UNAUTHORIZED = 401;
    const NOTFOUND = 404;

    public $resonse = array();
    public $code = Response::OK;
    public $headers = array();
    public $body;

    public function __construct($resonse) {
        $this->resonse = $resonse;
    }

    public function addHeader($header, $value) {
        header("{$header}:{$value}");
    }

    public function output() {
        $this->addHeader('Content-type', 'application/json');
        echo json_encode($this->resonse->output_data);
    }

}