<?php

class AttendRepository {

    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

    public function isUsedAlreadyAttend($data) {
        $this->db->from('attendees')
		->where('event_id = ', $data['event_id'])
		->where('user_id = ', $data['user_id'])
                ->one();
        
        if($this->db->count()==1)
            return TRUE;
        else 
            return FALSE;
    }

    public function add($data) {
     
        $return=$this->db->from('attendees')
                ->insert($data)
                ->execute();
        $this->updateAttende($data);
        
        return $return;

    }
    
    public function updateAttende($data){
      $edata['total_attending']=$this->countAttende($data);
        
        $updated=$this->db->from('events')
                ->where('event_id = ', $data['event_id'])
                ->update($edata)
                ->execute();
        
        return $updated;
    }
    
    public function countAttende($data){
        
         $all=$this->db->from('attendees')
		->where('event_id = ', $data['event_id'])
                ->many();
        return $totalAttend=count($all);
    }
    
    public function getAllAttende($id){
        
         $all=$this->db->from('attendees')
		->where('event_id = ', $id)
                 ->join('users', array('attendees.user_id' => 'users.user_id'))
                ->many();
        return $all;
    }

}