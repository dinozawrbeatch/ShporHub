<?php
class Users
{
    function __construct($db) {
        $this->db = $db;
    }

    public function login($login, $hash, $rand) {
        $user = $this->db->getUser($login);
        if($user){
            if ($hash === md5($user->hash.$rand)) {
                $token = md5($hash.rand());
                $this->db->updateToken($user->id, $token);
                return array(
                    'id' => $user->id,
                    'name' =>  $user->name,
                    'login' => $user->login,
                    'token' => $token,
                    'group' => $user->group_id,
                    'course'=> $user->course
                );
            }
        }
    }

    public function getUser($token) {
        return $this->db->getUser($token);
    }

    public function logout($userId) {
        return $this->db->updateToken($userId, '');
    }

    public function registration($login, $hash, $name, $course, $group_id) {  
        $course = (int)$course;
        $user = $this->db->getUser($login);
        $group = $this->db->getGroup($group_id);
        if(!$user && $group && $course >= 1 && $course <= 4) {
            return $this->db->addUser($login, $hash, $name, $course, $group_id);
        }
    }

    public function getGroups() {
        return $this->db->getGroups();
    }
}


/*

    workbench

    В апп проверяем параметры 
    в модуле проверяем чета

*/