<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1> user Profil </h1>

    <p>Nom: <?php echo $user['nom']; ?> </p>
    <p>Date d'inscription: <?php echo $user['date_inscription']; ?> </p>
    <p>Genre: <?php echo $user['genre']; ?> </p>
    <p>Gold: <?php echo $user['gold'] ? 'Oui' : 'Non'; ?> </p>

</body>
</html>