<?php
    class Profile
    {
        function __construct($db)
        {
            $this->db = $db;
        }
    
        public function updateProfile($course, $group_id, $token){
            return $this->db->updateProfile($course, $group_id, $token);
        }
    }