<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Memory Game</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/memory/public/css/style.css">
</head>

<body>
    
<audio autoplay loop>
     <!-- <source src="/memory/public/audio/background.mp3" type="audio/mpeg"> -->
    Votre navigateur ne supporte pas la lecture audio.
</audio>
    <header>
        <h1>🜂 Memory Game</h1>

        <nav>
            <ul class="nav-links">

                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="index.php?action=profile">Stats</a></li> 
                    <li><a href="index.php?action=play">Jouer</a></li>
                    <li><a href="index.php?action=top10">Top 10</a></li>
                    <li><a href="index.php?action=logout" class="logout">Déconnexion (<?= $_SESSION['username']; ?>)</a></li>
                <?php else: ?>
                    <li><a href="index.php?action=login">Connexion</a></li>
                    <li><a href="index.php?action=register">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    

    <main>
