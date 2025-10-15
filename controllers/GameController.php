<?php
require_once __DIR__ . '/../models/Game.php';
require_once __DIR__ . '/../models/Score.php';

class GameController
{
    private $game;
    private $scoreModel;

    public function __construct($numPairs = 3)
    {
        $this->game = new Game($numPairs);
        $this->scoreModel = new Score();
        $this->initSession();
    }

    private function initSession()
    {
        if (!isset($_SESSION['memory_game'])) {
            $_SESSION['memory_game'] = [
                'cards' => $this->game->cards,
                'flipped' => [],
                'matched' => [],
                'attempts' => 0,
                'pairs' => $this->game->getNumPairs(),
                'start_time' => microtime(true)
            ];
        }
    }

public function handleFlip($index)
{
    $state = &$_SESSION['memory_game'];

    if (!isset($state['flipped']) || !is_array($state['flipped'])) $state['flipped'] = [];
    if (!isset($state['matched']) || !is_array($state['matched'])) $state['matched'] = [];
    if (!isset($state['previous_flipped']) || !is_array($state['previous_flipped'])) $state['previous_flipped'] = [];

    // Rabattre les cartes non appariées précédentes
    if (!empty($state['previous_flipped'])) {
        $state['flipped'] = [];
        $state['previous_flipped'] = [];
    }

    // Ignorer si la carte est déjà retournée ou déjà appariée
    if (in_array($index, $state['flipped']) || in_array($index, $state['matched'])) return;

    $state['flipped'][] = $index;

    if (count($state['flipped']) == 2) {
        $state['attempts']++;
        $first = $state['flipped'][0];
        $second = $state['flipped'][1];

        if ($state['cards'][$first]->id == $state['cards'][$second]->id) {
            // Paire correcte
            $state['matched'][] = $first;
            $state['matched'][] = $second;
            $state['flipped'] = []; // vider flipped car ce sont des cartes “définitives”
        } else {
            // Paire incorrecte, on garde visible jusqu'au prochain clic
            $state['previous_flipped'] = [$first, $second];
        }
    }
}




    public function checkVictory()
    {
        $state = $_SESSION['memory_game'];
        return count($state['matched']) == $state['pairs'] * 2;
    }

    public function getElapsedTime()
    {
        $start = $_SESSION['memory_game']['start_time'];
        return round(microtime(true) - $start, 2);
    }

    public function getCards()
    {
        return $_SESSION['memory_game']['cards'];
    }

    public function getFlipped()
    {
        return $_SESSION['memory_game']['flipped'];
    }

    public function getMatched()
    {
        return $_SESSION['memory_game']['matched'];
    }

    public function getAttempts()
    {
        return $_SESSION['memory_game']['attempts'];
    }

public function saveScore($user_id)
{
    $attempts = $this->getAttempts();
    $time = $this->getElapsedTime();
    $pairs = $_SESSION['memory_game']['pairs'] ?? 3;

    return $this->scoreModel->save($user_id, $attempts, $time, $pairs);
}


    public function resetGame()
    {
        unset($_SESSION['memory_game']);
    }

    public function getTop10()
    {
        return $this->scoreModel->getTop10();
    }
}
