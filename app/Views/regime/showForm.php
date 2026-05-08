<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <a href="<?= site_url('/regimes') ?>"> << Retour a la liste </a>

    <?php if (isset($regime)) { ?>
        <h1> Update Regime </h1>
        <form action="<?= site_url('/regimes/' . $regime['id'] . '/edit') ?>" method="post">

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?= esc($regime['nom']) ?>" required><br><br>
            <input type="number" id="pourcentage_viande" name="pourcentage_viande" value="<?= esc($regime['pourcentage_viande']) ?>" required><br><br>
            <label for="pourcentage_poisson">Pourcentage de poisson:</label>
            <input type="number" id="pourcentage_poisson" name="pourcentage_poisson" value="<?= esc($regime['pourcentage_poisson']) ?>" required><br><br>
            <label for="pourcentage_volaille">Pourcentage de volaille:</label>
            <input type="number" id="pourcentage_volaille" name="pourcentage_volaille" value="<?= esc($regime['pourcentage_volaille']) ?>" required><br><br>
            <label for="variation_poids">Variation de poids:</label>
            <input type="number" id="variation_poids" name="variation_poids" value="<?= esc($regime['variation_poids']) ?>" required><br><br>
            <label for="duree_jour">Durée en jours:</label>
            <input type="number" id="duree_jour" name="duree_jour" value="<?= esc($regime['duree_jour']) ?>" required><br><br>
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix" value="<?= esc($regime['prix']) ?>" required><br><br>
            
            <button type="submit">Update</button>

        </form>

    <?php } else { ?>
        <h1> Create Regime </h1>
        <form action="<?= site_url('/regimes/create') ?>" method="post">

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required><br><br>
            <label for="pourcentage_viande">Pourcentage de viande:</label>
            <input type="number" id="pourcentage_viande" name="pourcentage_viande" required><br><br>
            <label for="pourcentage_poisson">Pourcentage de poisson:</label>
            <input type="number" id="pourcentage_poisson" name="pourcentage_poisson" required><br><br>
            <label for="pourcentage_volaille">Pourcentage de volaille:</label>
            <input type="number" id="pourcentage_volaille" name="pourcentage_volaille" required><br><br>
            <label for="variation_poids">Variation de poids:</label>
            <input type="number" id="variation_poids" name="variation_poids" required><br><br>
            <label for="duree_jour">Durée en jours:</label>
            <input type="number" id="duree_jour" name="duree_jour" required><br><br>
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix" required><br><br>

            <button type="submit">Create</button>

        </form>

    <?php } ?>

</body>
</html>