<?php
require_once 'db/DB.php';
require_once 'users/Users.php';
require_once 'profile/Profile.php';
require_once 'subjects/Subjects.php';

class Application
{
    public function __construct()
    {
        $db = new DB();
        $this->users = new Users($db);
        $this->profile = new Profile($db);
        $this->subjects = new Subjects($db);
    }

    public function login($params)
    {
        if ($params['login'] &&
            $params['hash'] &&
            $params['rand']
        ){
            return $this->users->login(
                $params['login'],
                $params['hash'],
                $params['rand']
            );
        }
    }

    public function logout($params)
    {
        if ($params['token']) {
            $user = $this->users->getUser($params['token']);
            if ($user) {
                return $this->users->logout($user->id);
            }
        }
    }

    public function registration($params)
    {
        if ($params['login'] &&
            $params['hash'] &&
            $params['name'] &&
            $params['course'] &&
            $params['group']
        ) {
            return $this->users->registration(
                $params['login'],
                $params['hash'],
                $params['name'],
                $params['course'],
                $params['group']
            );
        }
    }

    public function updateProfile($params)
    {

        if ($params['course'] &&
            $params['group'] &&
            $params['token']) {
            return $this->profile->updateProfile(
                $params['course'],
                $params['group'],
                $params['token']
            );
        }
    }

    public function getLessons($params)
    {
        $token = $params['token'];
        $id = $params['id'];
        if ($token && $id) {
            return $this->subjects->getLessons($token, $id);
        }
    }

    public function uploadShpora($params)
    {
        return $this->subjects->uploadShpora($params);
    }

    public function getGroups()
    {
        return $this->users->getGroups();
    }

    public function getShporsByLesson($params)
    {
        $discipline_id = $params['discipline_id'];
        if ($discipline_id) {
            return $this->subjects->getShporsByLesson($discipline_id);
        }
    }
    public function getShporsById($params)
    {
        $shpor_id = $params['shpor_id'];
        if ($shpor_id) {
            return $this->subjects->getShporsById($shpor_id);
        }
    }
}
