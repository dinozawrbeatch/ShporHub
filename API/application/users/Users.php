<?php
class Users
{
    function __construct($db) {
        $this->db = $db;
    }

    public function login($login, $hash, $rand) {
        $user = $this->db->getUser($login);
        if ($user) {
            if ($hash === md5($user->hash.$rand)) {
                $token = md5($hash.rand());
                $this->db->updateToken($user->id, $token);
                return array(
                    'name' => $user->name,
                    'token' => $token
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

    public function registration($params) {
        if($params['login'] && $params['hash']){
            return $this->db->addUser($params);
        } else {
            return array(
                'access' => false 
            );
        }
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

*/