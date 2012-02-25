<?php

class EventsResource extends Resource {

    public $output_data = array();
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

    public function get($id = 0) {
        if ($id > 0) {

            return $this->getEventById($id);
        } else {
            return $this->getAllEvents();
        }
    }

    public function exec($request) {
        //print_r($request);
        if ($request->resources[0] == 'events' && isset($request->resources[1])) {
            if (is_numeric($request->resources[1])) {
                if (App::getRepository('Event')->isEventHas($request->resources[1])) {
                    $this->output_data = $this->get(intval($request->resources[1]));
                } else {
                    $this->output_data = array("error" => "Event not found");
                }
            } else {
                $this->output_data = array("error" => "Invalid param");
            }
        } else if ($request->resources[0] == 'events') {
            $this->output_data = $this->get();
        }
        return new Response($this);
    }

    public function getAllEvents() {
        return App::getRepository('Event')->getAllEvent();
    }

    public function getEventById($id) {
        return App::getRepository('Event')->getEventById($id);
    }

}