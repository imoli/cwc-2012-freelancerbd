<?php

class TalksResource extends Resource {

    public $output_data = array();
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

    public function get($id = 0) {
        if ($id > 0) {

            return $this->getTalkById($id);
        } else {
            return $this->getAllTalks();
        }
    }

    public function exec($request) {
        //print_r($request);
        if ($request->resources[0] == 'talks' && isset($request->resources[1])) {
            if (is_numeric($request->resources[1])) {
                if (App::getRepository('Talk')->isTalkHas($request->resources[1])) {
                    $this->output_data = $this->get(intval($request->resources[1]));
                } else {
                    $this->output_data = array("error" => "Talk not found");
                }
            } else {
                $this->output_data = array("error" => "Invalid param");
            }
        } else if ($request->resources[0] == 'talks') {
            $this->output_data = $this->get();
        }
        return new Response($this);
    }

    public function getAllTalks() {
        return App::getRepository('Talk')->getAllTalk();
    }

    public function getTalkById($id) {
        return App::getRepository('Talk')->getTalkById($id);
    }

}