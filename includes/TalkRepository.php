<?php

class TalkRepository {

    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

    public function getTalksByEvent($eventId) {
        return $this->db->from('talks')
                        ->where('event_id = ', $eventId)
                        ->many();
    }

    public function getTalkById($talkId) {
        return $this->db->from('talks')
                        ->where('talk_id = ', $talkId)
                        ->one();
    }

    public function getAllTalk() {
        return $this->db->from('talks')
                        ->many();
    }

    public function tagCreate($data) {
        $data['user_id'] = $_SESSION['user']['user_id'];

        $insert = $this->db->from('tags')
                ->insert($data)
                ->execute();
        return $insert;
    }

    public function create($data) {
        $this->db->from('talks')
                ->insert($data)
                ->execute();

        return $this->db->insert_id;
    }

    public function getAllTags() {
        return $this->db->from('tags')
                        ->distinct()
                        ->select('tag')
                        ->many();
    }

    public function getAllTalkByTag($tag_name) {

        return $this->db->from('talks')
                        ->join('tags', array('tags.talk_id' => 'talks.talk_id'))
                        ->where('tag %', $tag_name . "%")
                        ->many();
    }

    public function getCommentCount($talkId) {
        $all = $this->db->from('comments')
                ->where('talk_id = ', $talkId)
                ->many();
        return count($all);
    }
    
    public function isTalkHas($talkId){
        return $this->db->from('talks')
                        ->where('talk_id = ', $talkId)
                        ->one();
    }

}