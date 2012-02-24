<?php

class CommentRepository {

    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

    public function getCommentsByTalk($talkId) {
        return $this->db->from('comments')
                ->join('users', array('comments.user_id' => 'users.user_id'))
                ->where('talk_id = ', $talkId)
                ->many();
    }

    public function create($data) {
        $data['user_id'] = $_SESSION['user']['user_id'];

        $insert=$this->db->from('comments')
                ->insert($data)
                ->execute();
            return $insert;
    }

     public function getCommentsByEvent($event_Id) {
        return $this->db->from('comments')
                ->join('users', array('comments.user_id' => 'users.user_id'))
                ->where('event_Id = ', $event_Id)
		->where('talk_Id = ', 0)
                ->many();
    }
    
}