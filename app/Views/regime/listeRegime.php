<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <a href="<?= site_url('/only-admin') ?>"><< Dashboard Admin </a>

    <h1>Liste des régimes</h1>

    <?php if (empty($regimes)): ?>
        <p>Aucun régime trouvé.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                <th>Nom</th>
                <th>Pourcentage Viande</th>
                <th>Pourcentage Poisson</th>
                <th>Pourcentage Volaille</th>
                <th>Variation Poids</th>
                <th>Durée Jour</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($regimes as $regime): ?>
            <tr>
                <td><?= esc($regime['nom']) ?></td>
                <td><?= esc($regime['pourcentage_viande']) ?> %</td>
                <td><?= esc($regime['pourcentage_poisson']) ?> %</td>
                <td><?= esc($regime['pourcentage_volaille']) ?> %</td>
                <td><?= esc($regime['variation_poids']) ?></td>
                <td><?= esc($regime['duree_jour']) ?></td>
                <td><?= esc($regime['prix']) ?></td>
                <td>
                    <a href="<?= site_url('/regimes/' . $regime['id']) .'/view' ?>">Modifier</a>
                    <a href="<?= site_url('/regimes/' . $regime['id']) . '/delete' ?>"> Supprimer </a>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <button><a href="<?= site_url('/regimes/showForm') ?>">Ajouter un régime</a></button>

</body>
</html>