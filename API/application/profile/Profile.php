<?php
    class Profile
    {
        function __construct($db)
        {
            
        }
    
        public function getProfile()
        {
            return array(
                'course' => 3,
                'direction' => 'iivt'
            );
        }
    
        public function updateProfile($params)
        {
            return true;
        }
    }