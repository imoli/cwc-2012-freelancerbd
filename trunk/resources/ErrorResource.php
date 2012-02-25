<?php

class ErrorResource extends Resource {

    public $output_data = array();
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

    public function exec($request) {
        $this->output_data = array("error" => "Invalid Param");
        return new Response($this);
    }

}