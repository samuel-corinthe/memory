<?php require __DIR__ . '/../layout/header.php'; ?>

<svg
    xmlns="http://www.w3.org/2000/svg"
    width="64" height="64"
    viewBox="0 0 64 64"
    fill="none"
>
    <!-- Base -->
    <rect x="24" y="52" width="16" height="4" fill="#FFD700" />
    
    <!-- Pied -->
    <rect x="28" y="32" width="8" height="20" fill="#FFD700" />
    
    <!-- Coupe -->
    <path
        d="M16 12C16 12 18 28 32 28C46 28 48 12 48 12C48 8 44 4 32 4C20 4 16 8 16 12Z"
        fill="#FFD700"
        stroke="#FFA500"
        stroke-width="2"
    />
    
    <!-- Poignées -->
    <path d="M14 14C12 18 12 24 14 28" stroke="#FFA500" stroke-width="2" />
    <path d="M50 14C52 18 52 24 50 28" stroke="#FFA500" stroke-width="2" />
</svg>
<h2> Top 10 Mondial</h2>

<table>
    <tr>
        <th>Joueur</th>
        <th>Paires</th>
        <th>Essais</th>
        <th>Temps (s)</th>
    </tr>
    <?php foreach ($top10 as $entry): ?>
        <tr>
            <td><?= htmlspecialchars($entry['username']) ?></td>
            <td><?= $entry['pairs'] ?></td>
            <td><?= $entry['score'] ?></td>
            <td><?= $entry['time'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="index.php?action=play">Rejouer</a>

<?php require __DIR__ . '/../layout/footer.php'; ?>
