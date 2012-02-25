<?php

class ApiRepository {

    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

    public function checkDuplicity($data){
		$data = $this->db->from('events')
				->where('title = ', $data['title'])
				->one();
		return $data;
	}

    public function create($data) {
        $data['user_id'] = $_SESSION['user']['user_id'];

        $this->db->from('events')
                ->insert($data)
                ->execute();

        return $this->db->insert_id;
    }
	/**
     * Get all events from any url
     *
     * @return array
     */
	public function getAllEvents($apiUrl) {
		//header("Content-type: application/json;");
		try{
			$getFileContents = file_get_contents($apiUrl);
			$jsonData = json_decode($getFileContents);
			return $jsonData;
		}catch(Exception $e){
			return "No JSon Data";
		}
	}
}