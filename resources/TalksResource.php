<?php

class TalksResource extends Resource {

    public $output_data = array();
    public $request;
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

    public function post() {
        if ($this->request->requestData['X-AUTH'] == "") {
            return array("error" => "Access token required");
        } else {
            $isValidUser = App::getRepository("User")->getUserByToken($this->request->requestData['X-AUTH']);
            if (empty($isValidUser)) {
                return array("error" => "Invalid token found");
            } else {
                $dataArr['event_id'] = $this->request->requestData['event_id'];
                $dataArr['title'] = trim(strip_tags($this->request->requestData['title']));
                $dataArr['summary'] = trim(strip_tags($this->request->requestData['summary']));
                $dataArr['speaker'] = trim(strip_tags($this->request->requestData['speaker']));
                $dataArr['slide_link'] = trim(strip_tags($this->request->requestData['slide_link']));
                $inputValidate = $this->validateInput($dataArr);
                if ($inputValidate === TRUE) {
                    if (App::getRepository("Talk")->create($dataArr)) {
                        return array("status" => 'success', "code" => '201');
                    }
                } else {
                    return array("error" => $inputValidate);
                }
            }
        }
        //print_r($this->request->requestData);
    }

    public function exec($request) {
        //print_r($request);
        $this->request = $request;
        if ($request->requestedMethod == 'GET') {
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
        } else if ($request->requestedMethod == 'POST') {

            if (!empty($request->requestData)) {
                $this->output_data = $this->post();
            } else {
                $this->output_data = array("error" => "Invalid param");
            }
        } // end post



        return new Response($this);
    }

    public function getAllTalks() {
        return App::getRepository('Talk')->getAllTalk();
    }

    public function getTalkById($id) {
        return App::getRepository('Talk')->getTalkById($id);
    }

    public function validateInput($data) {
        $errorArr = array();
        if (intval(trim(strip_tags($data['event_id']))) <= 0) {
            $errorArr['event_id'] = "Event id shoud not empty";
        }
        if (trim(strip_tags($data['title'])) == "") {
            $errorArr['ttile'] = "should not empty";
        }

        if (trim(strip_tags($data['summary'])) == "") {
            $errorArr['summary'] = "should not empty";
        }

        if (trim(strip_tags($data['speaker'])) == "") {
            $errorArr['speaker'] = "should not empty";
        }
        if (empty($errorArr)) {
            return TRUE;
        } else {
            return $errorArr;
        }
    }

}