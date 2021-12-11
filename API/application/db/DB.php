<?php

class DB
{
    public function __construct()
    {
        $host = 'localhost';
        $port = '3306';
        $name = 'shporhub';
        $user = 'root';
        $pass = '';
        try {
            $this->db = new PDO(
                'mysql:' .
                'host=' . $host . ';' .
                'port=' . $port . ';' .
                'dbname=' . $name,
                $user,
                $pass
            );
        } catch (Exception $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public function __destruct()
    {
        $this->db = null;
    }

    public function getUser($login)
    {
        $query = "SELECT *
            FROM users
            WHERE login='$login'";
        return $this->db->query($query)
            ->fetchObject();
    }

    public function getUserByToken($token)
    {
        $query = "SELECT * FROM users WHERE token='$token'";
        return $this->db->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->query($query);
        $result = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $result[] = $row;
        }
        return $result;
    }

    public function updateToken($id, $token)
    {
        $query = "UPDATE users
            SET token='$token'
            WHERE id='$id'";
        $this->db->query($query);
        return true;
    }

    public function addUser($login, $hash, $name, $course, $group_id)
    {
        $token = md5($hash);
        $query = "INSERT INTO users
        (login,name,hash, course, group_id, token, is_admin)
        VALUES('$login','$name','$hash', '$course' ,'$group_id','$token', false)";
        $this->db->query($query);
        return true;
    }

    /*
    function login($login, $rand)
    {

    }*/

    public function getGroups()
    {
        $query = "SELECT * FROM `groups`";
        return $this->db->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGroup($id)
    {
        $query = "SELECT * FROM `groups` WHERE id=" . $id;
        return $this->db->query($query)
            ->fetchObject();
    }

    public function updateProfile($course, $group_id, $token)
    {
        $user = $this->getUserByToken($token);
        if ($user) {
            $query = "UPDATE users SET `course` = $course, `group_id`=$group_id WHERE users.token = '$token'";

            return $this->db->query($query)
                ->fetchObject();
        }
    }
    public function getLessons($token)
    {
        $user = $this->getUserByToken($token);
        if ($user) {
            $query = "SELECT d.name,d.id FROM disciplines AS d
                    INNER JOIN groups_discipline AS gd
                    ON d.id=gd.discipline_id
                    INNER JOIN users AS u
                    ON u.id=18 AND u.group_id=gd.group_id";
            return array(
                $this->db->query($query)
                    ->fetchObject(),
            );
        }
    }
}
