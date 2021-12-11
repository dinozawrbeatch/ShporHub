<?php
class Subjects
{
    function __construct($db)
    {
        $this->db = $db;
    }

    public function getLessons($token,$id)
    {
        return $this->db->getLessons($token,$id);
    }

    public function uploadShpora($params)
    {
        $i = 0;
        $check = true;
        while($check){           
            if($_FILES['questions_'.$i]['error'] == 0){
                $questionName =  $_FILES['questions_'.$i]['name'];
                move_uploaded_file($_FILES['questions_'.$i]['tmp_name'], '../images/'.md5($questionName).'.png');
                $i++; 
            } 
            if($i > 15){
                $check = false;
            }
        }

        $i = 0;
        $check = true;
        while($check){
            if($_FILES['answers_'.$i]['error'] == 0){
                $answerName =  $_FILES['answers_'.$i]['name'];
                move_uploaded_file($_FILES['answers_'.$i]['tmp_name'], '../images/'.md5($answerName).'.png');
                $i++; 
            } 
            if($i > 15){
                $check = false;
            }
        }
        print_r($params['data']);
        print_r($params['type']);
        print_r($params['description']);

        return 'Загрузка выполнена';
    }

    public function getShpora($params)
    {
        if($params['id'] == 3){
            return array(
                array(
                    'question'=>'http://shporhub/images/s1.jpg',
                    'answer'=>'http://shporhub/images/s1.jpg'
                ),
                array(
                    'question'=>'http://shporhub/images/s1.jpg',
                    'answer'=>'http://shporhub/images/s1.jpg'
                ),
                array(
                    'question'=>'http://shporhub/images/s1.jpg',
                    'answer'=>'http://shporhub/images/s1.jpg'
                ),
                array(
                    'question'=>'http://shporhub/images/s1.jpg',
                    'answer'=>'http://shporhub/images/s1.jpg'
                ),
                array(
                    'question'=>'http://shporhub/images/s1.jpg',
                    'answer'=>'http://shporhub/images/s1.jpg'
                )
            );
        }
    }
}





