<?php

class EventRepository {

    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

      public function getActiveEvents($limit,$offset) {
        return $this->db->from('events')
                ->where('is_active = ', 1)
				->limit($limit,$offset)
				->sortDesc('event_id')
                ->many()
	;
    }

    public function getActiveEventsByCategory($categoryId) {
        return $this->db->from('events')
                ->where('is_active = ', 1)
                ->where('category_id = ', $categoryId)
                ->many();
    }

    public function getEventById($eventId) {
        return $this->db->from('events')
                ->where('event_id = ', $eventId)
                ->one();
    }

    public function create($data) {
        $data['user_id'] = $_SESSION['user']['user_id'];

        $this->db->from('events')
                ->insert($data)
                ->execute();

        return $this->db->insert_id;
    }
    
    public function countActiveEvents(){
		$all=$this->db->from('events')
					->many();
		return $totalAttend=count($all);
	}
   
   public function isEventHas($eventId){
    return $this->db->from('events')
                    ->where('event_id = ', $eventId)
                    ->one();
 }
   public function getAllEvent() {
        return $this->db->from('events')
                    ->many();
}
}