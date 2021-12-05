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
                    'name' =>  $user->name,
                    'login' => $user->login,
                    'token' => $user->token,
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
    Переписать код по крутому
    заполнить БД (3 строчки минимум в каждой таблице)
    при логине, возвращать: логин, токен, группу, курс, выбрать шпоры по курсу и предметАМ(три щтучьки, которые напишешь)

    записывать кто загрузил фотку когда, и какой курс и направление

    workbench

    Админка:
    uploadShpora (POST)


    В апп проверяем параметры 
    в модуле проверяем чета

*/