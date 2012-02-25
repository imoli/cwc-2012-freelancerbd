<?php

/**
 * Process the incoming HTTP request
 */
class Request {

    public $uri;
    public $supportedHttpMethods = array('GET', 'POST');
    public $defaultMethod = 'GET';
    public $requestData;
    public $resources = array();
    public $output_data = array();

    public function __construct($requestData = array()) {
        $this->requestData = $requestData;
    }

    public function loadResource() {
        $this->parseRequestUrl();

        if ($this->getRequestType() == 'GET') {
            if ($this->resources[0] == 'talks') {
                return App::getResource("Talks");
            } else {
                return App::getResource("Error");
            }
        } else if ($this->getRequestType() == 'POST') {
            
        }
    }

    public function getRequestType() {
        $rType = $_SERVER['REQUEST_METHOD'];
        if (in_array($rType, $this->supportedHttpMethods)) {
            return $rType;
        } else {
            return $this->defaultMethod;
        }
    }

    public function parseRequestUrl() {
        //echo "<pre>".print_r($_SERVER,true)."</pre>";
        $this->uri = $_SERVER['REQUEST_URI'];
        $apiUrl = substr($this->uri, strpos($this->uri, 'api/') + 4);
        $this->resources = explode("/", $apiUrl);
    }

    public function showError() {
        return new Response($this);
    }

}
