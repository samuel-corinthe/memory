<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Score.php';

class ProfileController
{
    private $user;
    private $score;

    public function __construct()
    {
        $this->user = new User();
        $this->score = new Score();
    }

    public function getProfile($id)
    {
        return $this->user->getUser($id);
    }

    public function getScores($user_id)
    {
        return $this->score->getUserScores($user_id);
    }
}
