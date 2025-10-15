<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/Card.php';

class Game
{
    public $cards = [];
    private $numPairs;
    private $startTime;

    public function __construct($numPairs = 3)
    {
        $this->numPairs = $numPairs;
        $this->loadCards();
    }

    public function getNumPairs()
    {
        return $this->numPairs;
    }

    private function loadCards()
    {
        $available = range(1, 12);
        shuffle($available);
        $selected = array_slice($available, 0, $this->numPairs);

        foreach ($selected as $id) {
            $imagePath = "public/images/card" . str_pad($id, 2, '0', STR_PAD_LEFT) . ".png";
            $this->cards[] = new Card($id, $imagePath);
            $this->cards[] = new Card($id, $imagePath);
        }

        shuffle($this->cards);
    }
}
