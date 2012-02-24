<?php

class SearchRepository {

    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

   public function getSearchByType($title,$search_type,$limit,$offset) {
        if($search_type == "talks")
		{
		return $this->db->from('talks')
                ->where('title %', $title."%" )
		->limit($limit,$offset)
                ->many();
		}
		else
		{
		return $this->db->from('events')
                ->where('title %', $title."%" )
		->limit($limit,$offset)
                ->many();
		}

    }
	


}