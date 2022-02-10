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
        return $this->db->uploadShpora($params);
    }
}
