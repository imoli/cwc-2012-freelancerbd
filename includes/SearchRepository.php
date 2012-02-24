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
	   $sql_arr = array();
	   $sql_str="";
	   $keywords = explode(" ",$title);
	   if(empty($keywords)){
		   return false;
	   }else{
		   foreach($keywords as $kw){
		   		$sql_arr[]="title LIKE '%{$kw}%'";
				$sql_arr[]="summary LIKE '%{$kw}%'";
		   }
		   $sql_str=implode(" OR ",$sql_arr);
	   }
	   
		return $this->db->from($search_type)
                ->where($sql_str)
				->limit($limit,$offset)
                ->many();

    }
	


}