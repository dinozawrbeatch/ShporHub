<?php
class DB {
    function __construct() {
        $host = 'localhost';
        $port = '3306';
        $name= 'shporhub';
        $user = 'root';
        $pass = 'root';
        try {
            $this->db = new PDO(
                'mysql:'.
                'host='.$host.';'.
                'port='.$port.';'.
                'dbname='.$name,
                $user,
                $pass
            );
        } catch (Exception $e) {
            print_r($e->getMessage());
            die();
        }
    }

    function __destruct() {
        $this->db = null;
    }

    public function getUser($login) {
        $query = 'SELECT * 
            FROM users 
            WHERE login="'.$login.'"';
        return $this->db->query($query)
            ->fetchObject();
    }

    public function getUserByToken($token) {
        $query = 'SELECT * 
            FROM users 
            WHERE token="'.$token.'"';
        return $this->db->query($query)
            ->fetchObject();
    }

    public function getUsers() {
        $query = 'SELECT * FROM users';
        $stmt = $this->db->query($query);
        $result = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $result[] = $row;
        }
        return $result;
    }

    public function updateToken($id, $token) {
        $query = 'UPDATE users 
            SET token="'.$token.'" 
            WHERE id='.$id;
        $this->db->query($query);
        return true;
    }

    public function addUser($params){
        $name = $params['name'];
        $token= md5($params['hash']);
        $login = $params['login'];
        $hash = $params['hash'];
        if($this->getUser($login)){
            print_r('Такой логин занят');
            return array(
                'access' => false
            );
        }
        $query = "INSERT INTO users
        (login,name,hash, course, group_id, token, is_admin)
        VALUES('$login','$name','$hash', 1 , 1,'$token', false)";
        $this->db->query($query);
        return array(
            'access' => true 
        );
    }

    
    function login($params)
    {
        $hash = $params['hash'];
        $login = $params['login'];
        $hash = md5($params['hash'].$params['rand']);
        print_r($hash);
        $query = "SELECT * FROM users WHERE login='$login'AND hash='$hash'";
        if($query){
            return array(
                'name' => $query['name'],
                'login' => $query['login'],
                'token' => $query['token'],
                'group' => $query['group'],
                'course' => $query['course']
            );
        }
    }

    public function getGroups() {
        $query = "SELECT * FROM `groups`";
        return $this->db->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}

