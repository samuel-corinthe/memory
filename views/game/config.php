<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Configurer votre partie</h2>

<form method="post" action="index.php?action=play">
    <label for="numPairs">Nombre de paires :</label>
    <select name="numPairs" id="numPairs" required>
        <?php for ($i = 3; $i <= 10; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?> paires</option>
        <?php endfor; ?>
    </select>
    <br><br>
    <button type="submit" class="start-button">Commencer le jeu</button>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>
