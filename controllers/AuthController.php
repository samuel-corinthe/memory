<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

public function register($username, $password)
{
    // Regex pour valider le mot de passe
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$.!%(+;)\*\/\-_{}#~$*%:!,<²°>ù^`|@[\]*?&]).{8,}$/';

    if (!preg_match($pattern, $password)) {
        return [
            'success' => false,
            'message' => 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.'
        ];
    }

    // Vérifier si l'utilisateur existe déjà
    if ($this->user->exists($username)) {
        return [
            'success' => false,
            'message' => 'Ce nom d’utilisateur est déjà utilisé.'
        ];
    }

    // Si valide, appeler la méthode User->register
    return $this->user->register($username, $password);
}


    public function login($username, $password)
    {
        return $this->user->login($username, $password);
    }

    public function logout()
    {
        session_start();
        session_destroy();
    }
}
