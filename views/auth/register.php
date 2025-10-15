<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Inscription</h2>

<?php if(!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>


<form method="post" action="index.php?action=register">
    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">S'inscrire</button>
</form>

<p>Déjà un compte ? <a href="index.php?action=login">Se connecter</a></p>

<?php require __DIR__ . '/../layout/footer.php'; ?>
