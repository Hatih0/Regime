<?php 
    $gold_inf = $user['gold'] == 1 ? "Vous êtes abonné à l'offre gold" : "Vous n'êtes pas abonné à l'offre gold";
    $objectifLabels = [1 => 'Prise de masse musculaire', 2 => 'Perte de poids', 3 => 'Atteindre mon IMC idéal'];
    $mon_objectif = isset($objectifsInfos[0]) ? $objectifLabels[$objectifsInfos[0]['id_objectif']] : "Aucun objectif";
    $dateInsc = date('d/m/Y', strtotime($user['date_inscription']));
    $dateMesure = date('d/m/Y H:i', strtotime($santeInfos[0]['date_mesure']));
    $dateObjectif = date('d/m/Y', strtotime($objectifsInfos[0]['date_choix']));
    $imcFormatted = number_format($imc, 2, ',', ' ');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <style>
        #email { color: gray; }
        #dateinscription { color: gray; }
        .section { margin: 30px 0; border-top: 1px solid #ccc; padding-top: 20px; }
        form { margin: 15px 0; padding: 15px; border: 1px solid #ddd; }
        input, select { padding: 8px; margin: 5px 0; width: 250px; }
        button { padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($user['nom']) ?></h1>
    <p id="email">Email: <?= htmlspecialchars($user['email']) ?></p>
    <p id="dateinscription">Date d'inscription: <?= $dateInsc ?></p>
    <p><?= $gold_inf ?></p>

    <div class="section">
        <h2>Mes informations de santé actuelles</h2>
        <p>Taille actuelle : <?= htmlspecialchars($santeInfos[0]['taille']) ?> cm</p>
        <p>Poids actuel : <?= htmlspecialchars($santeInfos[0]['poids']) ?> kg</p>
        <p>Date de dernière mesure : <?= $dateMesure ?></p>
        <p>IMC : <?= $imcFormatted ?></p>
    </div>

    <div class="section">
        <h2>Mon objectif - posé le <?= $dateObjectif ?></h2>
        <p><?= htmlspecialchars($mon_objectif) ?></p>
        <p>Valeur cible : <?= htmlspecialchars($objectifsInfos[0]['poids']) ?></p>
    </div>

    <div class="section">
        <h2>Soumettre une nouvelle mesure</h2>
        <form action="/update-sante" method="post">
            <input type="hidden" name="id_utilisateur" value="1">
            <label>Poids (kg) :</label><br>
            <input type="number" name="poids" step="0.1" required><br>
            <label>Taille (cm) :</label><br>
            <input type="number" name="taille" step="0.1" required><br>
            <button type="submit">Valider ma nouvelle mesure</button>
        </form>
    </div>

    <div class="section">
        <h2>Soumettre un nouvel objectif</h2>
        <form action="/update-objectif" method="post">
            <input type="hidden" name="id_utilisateur" value="1">
            <label>Objectif :</label><br>
            <input type="radio" name="id_objectif" value="1" id="obj_1">
            <label for="obj_1">Prise de masse musculaire</label><br>
            <input type="radio" name="id_objectif" value="2" id="obj_2" checked>
            <label for="obj_2">Perte de poids</label><br>
            <input type="radio" name="id_objectif" value="3" id="obj_3">
            <label for="obj_3">Atteindre mon IMC idéal</label><br>
            <label>Valeur cible :</label><br>
            <input type="number" name="poids" id="objectif_valeur" step="0.1" value="10" required><br>
            <button type="submit">Valider mon nouvel objectif</button>
        </form>
    </div>

    <div class="section">
        <h2>Modifier mes informations personnelles</h2>
        <form action="/update-utilisateur" method="post">
            <input type="hidden" name="id_utilisateur" value="1">
            <label>Nom :</label><br>
            <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required><br>
            <label>Email :</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>
            <label>Genre :</label><br>
            <input type="radio" name="genre" value="Homme" id="gen_h" <?= $user['genre'] === 'Homme' ? 'checked' : '' ?>>
            <label for="gen_h">Homme</label><br>
            <input type="radio" name="genre" value="Femme" id="gen_f" <?= $user['genre'] === 'Femme' ? 'checked' : '' ?>>
            <label for="gen_f">Femme</label><br>
            <input type="radio" name="genre" value="Autre" id="gen_a" <?= $user['genre'] === 'Autre' ? 'checked' : '' ?>>
            <label for="gen_a">Autre</label><br>
            <button type="submit">Valider mes modifications</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('input[name="id_objectif"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const valeur = document.getElementById('objectif_valeur');
                if (this.value === '3') {
                    valeur.value = 22.0;
                } else {
                    valeur.value = 10;
                }
            });
        });
    </script>
</body>
</html>