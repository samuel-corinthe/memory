<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Connexion</h2>

<?php if(!empty($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="post" action="index.php?action=login">
    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<p>Pas encore inscrit ? <a href="index.php?action=register">Créer un compte</a></p>

<?php require __DIR__ . '/../layout/footer.php'; ?>
