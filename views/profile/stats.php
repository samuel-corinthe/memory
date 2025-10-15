<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Profil de <?= htmlspecialchars($user['username']); ?></h2>

<h3>Mes scores :</h3>
<table>
    <thead>
        <tr>
            <th>Essais</th>
            <th>Temps (s)</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($scores as $s): ?>
        <tr>
            <td><?= $s['score'] ?></td>
            <td><?= $s['time'] ?? '-' ?></td> 
            <td><?= $s['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p><a href="index.php?action=top10">Voir le Top 10</a></p>

<?php require __DIR__ . '/../layout/footer.php'; ?>
