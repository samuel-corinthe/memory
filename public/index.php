<?php
require_once '../controllers/AuthController.php';
require_once '../controllers/GameController.php';
require_once '../controllers/ProfileController.php';

session_start();
$action = $_GET['action'] ?? 'home';

switch ($action) {

// rgister
case 'register':
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $auth = new AuthController();
        $result = $auth->register($_POST['username'], $_POST['password']);

        if (is_array($result) && isset($result['success']) && $result['success'] === false) {
           
            $error = $result['message'];
        } else {
            
            header('Location: index.php?action=login');
            exit;
        }
    }
    require '../views/auth/register.php';
    break;


    // login
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new AuthController();
            if ($auth->login($_POST['username'], $_POST['password'])) {
                header('Location: index.php?action=play');
                exit;
            } else {
                $error = "Identifiants incorrects";
            }
        }
        require '../views/auth/login.php';
        break;

    // logout
    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        header('Location: index.php?action=login');
        exit;

    // game
    case 'play':
    if (!isset($_SESSION['user_id'])) header('Location: index.php?action=login');

  
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numPairs'])) {
        $_SESSION['numPairs'] = intval($_POST['numPairs']);
        unset($_SESSION['memory_game']); 
        $numPairs = $_SESSION['numPairs'];
        $game = new GameController($numPairs);
        $cards = $game->getCards();
        require '../views/game/play.php';
        break;
    }

    if (!isset($_SESSION['memory_game'])) {
        require '../views/game/config.php';
        break;
    }

    $numPairs = $_SESSION['numPairs'] ?? 3;
    $game = new GameController($numPairs);

    // Gestion du flip
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['card_index'])) {
        $game->handleFlip(intval($_POST['card_index']));
    }

    $cards = $game->getCards();
    require '../views/game/play.php';
    break;


    // --- QUIT ---
    case 'quit':
        unset($_SESSION['memory_game']);
        header('Location: index.php?action=profile'); // ou home
        exit;

    // --- PROFILE ---
    case 'profile':
        if (!isset($_SESSION['user_id'])) header('Location: index.php?action=login');
        $profileCtrl = new ProfileController();
        $user = $profileCtrl->getProfile($_SESSION['user_id']);
        $scores = $profileCtrl->getScores($_SESSION['user_id']);
        require '../views/profile/stats.php';
        break;

    // --- TOP 10 ---
    case 'top10':
        $gameCtrl = new GameController();
        $top10 = $gameCtrl->getTop10();
        require '../views/classement/top10.php';
        break;

    // --- HOME ---
    default:
        echo "<h2>Bienvenue sur Memory Game 2.0</h2>";
        if (isset($_SESSION['username'])) {
            echo "<p>Bonjour {$_SESSION['username']} !</p>";
            echo "<p><a href='index.php?action=play'>Jouer</a> | <a href='index.php?action=profile'>Profil</a> | <a href='index.php?action=top10'>Top 10</a> | <a href='index.php?action=logout'>Déconnexion</a></p>";
        } else {
            echo "<p><a href='index.php?action=login'>Se connecter</a> | <a href='index.php?action=register'>S'inscrire</a></p>";
        }
        break;
}
