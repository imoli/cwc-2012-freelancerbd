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
	
	public function post() {
        if ($this->request->requestData['X-AUTH'] == "") {
            return array("error" => "Access token required");
        } else {
            $isValidUser = App::getRepository("User")->getUserByToken($this->request->requestData['X-AUTH']);
            if (empty($isValidUser)) {
                return array("error" => "Invalid token found");
            } else {
				//print_r($isValidUser);
				$_SESSION['user']['user_id'] = $isValidUser['user_id'];
                $dataArr['title'] = trim(strip_tags($this->request->requestData['title']));
                $dataArr['summary'] = trim(strip_tags($this->request->requestData['summary']));
                $dataArr['category_id'] = trim(strip_tags($this->request->requestData['category_id']));
				$dataArr['location'] = trim(strip_tags($this->request->requestData['location']));
				$dataArr['href'] = trim(strip_tags($this->request->requestData['href']));
				$dataArr['start_date'] = trim(strip_tags($this->request->requestData['start_date']));
				$dataArr['end_date'] = trim(strip_tags($this->request->requestData['end_date']));
                $inputValidate = $this->validateInput($dataArr);
                if ($inputValidate === TRUE) {
                    if (App::getRepository("Event")->create($dataArr)) {
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
		}
        else if ($request->requestedMethod == 'POST') {

            if (!empty($request->requestData)) {
                $this->output_data = $this->post();
            } else {
                $this->output_data = array("error" => "Invalid param");
            }
        } // end post
        return new Response($this);
    }

    public function getAllEvents() {
        return App::getRepository('Event')->getAllEvent();
    }

    public function getEventById($id) {
        return App::getRepository('Event')->getEventById($id);
    }
	
	public function validateInput($data) {
        $errorArr = array();
        if (trim(strip_tags($data['title'])) == "") {
            $errorArr['ttile'] = "Should not empty";
        }
        if (trim(strip_tags($data['summary'])) == "") {
            $errorArr['summary'] = "Should not empty";
        }
		if (intval(trim(strip_tags($data['category_id']))) <= 0) {
			$errorArr['category_id'] = "Category Id should not empty";
		}
        if (trim(strip_tags($data['location'])) == "") {
            $errorArr['location'] = "Location Should not empty";
        }
        if (trim(strip_tags($data['start_date'])) == "") {
            $errorArr['start_date'] = "Start Date Should not empty";
        }
        if (trim(strip_tags($data['end_date'])) == "") {
            $errorArr['end_date'] = "End Date Should not empty";
        }
		if (strtotime($data['start_date']) > strtotime($data['end_date']))
		{
			$errorArr['date_range'] = "The end date must be greater than the start date.";
		}
        if (empty($errorArr)) {
            return TRUE;
        } else {
            return $errorArr;
        }
    }

}