<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Memory Game</h2>

<?php
// Initialisation des variables pour afficher le plateau
$flipped = $_SESSION['memory_game']['flipped'] ?? [];
$matched = $_SESSION['memory_game']['matched'] ?? [];
$cards   = $_SESSION['memory_game']['cards'] ?? [];
$attempts = $_SESSION['memory_game']['attempts'] ?? 0;
$startTime = $_SESSION['memory_game']['start_time'] ?? microtime(true);
$elapsed = round(microtime(true) - $startTime, 2);
?>

<!-- Choix du nombre de paires -->
<form method="post" class="config-form">
    <label for="numPairs">Nombre de paires :</label>
    <select name="numPairs" id="numPairs" onchange="this.form.submit()">
        <?php for ($i = 3; $i <= 10; $i++): ?>
            <option value="<?= $i ?>" <?= ($_SESSION['numPairs'] ?? 3) == $i ? 'selected' : '' ?>>
                <?= $i ?> paires
            </option>
        <?php endfor; ?>
    </select>
</form>

<p>Essais : <?= $attempts ?></p>
<p>Temps : <?= $elapsed ?> secondes</p>

<!-- Bouton quitter -->
<p><a href="index.php?action=quit" class="quit-button">Quitter le jeu</a></p>

<!-- Plateau de jeu -->
<form method="post">
    <div class="game-board">
        <?php
        foreach ($cards as $i => $card):
            $show = in_array($i, $flipped) || in_array($i, $matched);
        ?>
            <button type="submit" name="card_index" value="<?= $i ?>" class="card"
                    onclick="document.getElementById('flipSound').play();">
                <img src="<?= $show ? '/memory/' . $card->image : '/memory/public/images/back.png' ?>" alt="Carte">
            </button>
        <?php endforeach; ?>
    </div>
</form>

<?php
// Gestion de la victoire
if ($game->checkVictory()):
    $time = $game->getElapsedTime();
    echo "<h2>Félicitations !</h2>";
    echo "<p>Vous avez gagné en $attempts essais et $time secondes.</p>";
    $game->saveScore($_SESSION['user_id']);
    $game->resetGame();
    echo "<a href='index.php?action=play'>Rejouer</a> | <a href='index.php?action=quit'>Quitter</a>";
endif;
?>


<?php require __DIR__ . '/../layout/footer.php'; ?>
