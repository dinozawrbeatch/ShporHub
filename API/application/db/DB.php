<?php
use MongoDB\Driver\Query;

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
        }
        catch (Exception $e) {
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
        $query = "SELECT * FROM `users` WHERE token='$token'";
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
        $query = "UPDATE users SET `course` = $course, `group_id`=$group_id WHERE users.token = '$token'";
        $this->db->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);
        return true;
    }

    public function getLessons($user, $id)
    {
        $query = "SELECT d.name,d.id FROM disciplines AS d
            INNER JOIN groups_discipline AS gd
            ON d.group_id=gd.discipline_id
            INNER JOIN users AS u
            ON u.id=$id AND u.group_id=gd.group_id AND u.course = d.course";   
        return  $this->db->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getShporsByLesson($discipline_id)
    {
        $imageType = '.jpg';
        $link = 'http://shporhub/images/';
        $query = "SELECT * FROM `shpors` WHERE discipline_id ='$discipline_id' AND num = 1";
        $answers = $this->db->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);
        $shpors = array();
        foreach ($answers as $shpor) {
            array_push($shpors, array(
                'date' => $shpor['date'],
                'type' => $shpor['type'],
                'shpor_id' => $shpor['shpor_id'],
                'description' => $shpor['description'],
                'img' => $link . $shpor['file_name'] . $imageType,
            ));
        }
        return $shpors;
    }

    public function getShporsById($shpor_id)
    {
        $imageType = '.jpg';
        $link = 'http://shporhub/images/';
        $query = "SELECT * FROM `shpors` WHERE shpor_id = $shpor_id";
        $answer = $this->db->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);
        $shpors = array();
        foreach ($answer as $image) {
            array_push($shpors, array(
                'img' => $link . $image['file_name'] . $imageType,
                'num' => $image['num'],
            ));
        }
        return $shpors;
    }

    public function getNextShporId()
    {
        $query = "SELECT `shpor_id` FROM shpors ORDER BY id DESC LIMIT 1";
        $lastId = $this->db->query($query)
            ->fetchObject();
        $lastId=(int)$lastId; 
        return $lastId++;
    }
    public function uploadShpora($params)
    {
        $nextId = $this->getNextShporId();
        $i = 0;
        $check = true;
        while ($check) {
            if ($_FILES['questions_' . $i]['error'] == 0) {
                $questionName = md5($_FILES['questions_' . $i]['name']);
                $query ="INSERT INTO `shpors`
                (file_name,min_file_name,discipline_id,num,description,type,shpor_id,date)
                VALUE ('$questionName',' ',' ')";
                move_uploaded_file($_FILES['questions_' . $i]['tmp_name'], '../images/' . $questionName . '.png');
                $i++;
            }

            if ($i > 15) {
                $check = false;
            }
        }

        while($check) {
            if ($_FILES['answers_' . $i]['error'] == 0) {
                $answerName = $_FILES['answers_' . $i]['name'];
                move_uploaded_file($_FILES['answers_' . $i]['tmp_name'], '../images/' . md5($answerName) . '.png');
                $i++;
            }

            if ($i > 15) {
                $check = false;
            }
        }

        
        
        print_r($params['time']);
        print_r($params['type']);
        print_r($params['description']);

        return 'Загрузка выполнена';
    }
}
