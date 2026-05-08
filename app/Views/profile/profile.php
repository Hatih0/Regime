<?php 
  
    $gold_inf = $user['gold'] == 1 ? "Vous êtes abonné à l'offre gold" : "Vous n'êtes pas abonné à l'offre gold";
    // $mon_objectif = $objectifs[0]['nom'];
    $mon_objectif = "NULLO" ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #email {
            color: gray;
        }

        #dateinscription {
            color: gray;
        }
    </style>
</head>
<body>
    <h1><?= $user['nom'] ?></h1>
    <p id="email">Email: <?= $user['email'] ?></p>
    <p id="dateinscription">Date d'inscription: <?= $user['date_inscription'] ?></p>
    <p> <?= $gold_inf?></p>

    <br><br>
    <p> Taille actuelle : <?= $santeInfos[0]['taille'] ?> cm</p>
    <p> Poids actuel : <?= $santeInfos[0]['poids'] ?> kg</p>
    <p>Date de derniere mesure : <?= $santeInfos[0]['date_mesure'] ?></p>
    <p>IMC : <?= $imc ?></p>

    <h2>Mon but posee depuis le <?= $objectifsInfos[0]['date_choix'] ?>
    <!-- <p></p> -->
    <?= $mon_objectif ?></h2>
    <p>Poids visee : <?= $objectifsInfos[0]['poids'] ?> kg</p>
    <p><a href="#">Soummettre un nouvel objectif</a></p>
    <p><a href="#">Soummettre une nouvelle mesure</a></p>
    <p><a href="#">Modifier mes informations personnelles</a></p>
    
</body>
</html>