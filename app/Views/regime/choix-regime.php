<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix regime</title>
</head>
<body>
    <h1>Choix des regimes et activite</h1>
    <form action="calcul-regime" method="post">
        <p>Votre Option</p>
        <br>
        <input type="radio" name="regime" id="regime1" value="rapide"  checked>
        <label for="regime1">Rapide +</label>
        <br>
        <input type="radio" name="regime" id="regime2" value="economique">
        <label for="regime2">Economique +</label>
        <br>
        <input type="radio" name="regime" id="regime3" value="sportif">
        <label for="regime3">Sportif +</label>
        <br>
        <button type="submit">Soumettre</button>

    </form>
    

</body>
</html>