<?php
class Subjects
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getShporsById($shpor_id)
    {
        return $this->db->getShporsById($shpor_id);
    }

    public function getShporsByLesson($discipline_id)
    {
        return $this->db->getShporsByLesson($discipline_id);
    }

    public function getLessons($user,$id)
    {
        return $this->db->getLessons($user,$id);
    }

    public function uploadShpora($params)
    {
        $i = 0;
        $check = true;
        while ($check) {
            if ($_FILES['questions_' . $i]['error'] == 0) {
                $questionName = $_FILES['questions_' . $i]['name'];
                move_uploaded_file($_FILES['questions_' . $i]['tmp_name'], '../images/' . md5($questionName) . '.png');
                $i++;
            }
            if ($i > 15) {
                $check = false;
            }
        }

        $i = 0;
        $check = true;
        while ($check) {
            if ($_FILES['answers_' . $i]['error'] == 0) {
                $answerName = $_FILES['answers_' . $i]['name'];
                move_uploaded_file($_FILES['answers_' . $i]['tmp_name'], '../images/' . md5($answerName) . '.png');
                $i++;
            }
            if ($i > 15) {
                $check = false;
            }
        }
        print_r($params['data']);
        print_r($params['type']);
        print_r($params['description']);

        return 'Загрузка выполнена';
    }
}
