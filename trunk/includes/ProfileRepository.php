<?php

class ProfileRepository {

    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct(Sparrow $db) {
        $this->db = $db;
    }

   public function getUserById($userId) {
        return $this->db->from('users')
                ->where('user_id = ', $userId)
                ->one();
    }
	
	public function updateName($userId, $data) {
        return $this->db->from('users')
                ->where('user_id = ', $userId)
				->update($data)
                ->execute();
    }

}