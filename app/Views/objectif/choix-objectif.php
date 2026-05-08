<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisissez votre objectif</title>
</head>
<body>
    <h1>Choisissez votre objectif</h1>
    <form action="/create-objectif" method="post">
        <input type="number" name="id" id="id" placeholder="ID Utilisateur" required>
        <br>
        <select name="choix" id="choix" required>
            <option value="">Choisissez votre objectif</option>
            <option value="1">Prise de masse musculaire</option>
            <option value="2">Perte de poids</option>
            <option value="3">Atteindre mon IMC ideal</option>
        </select>
        <br>
        <input type="number" name="poids" id="poids" placeholder="Poids (kg) ou IMC (kg/cm²)" required>
        <br>
        <button type="submit">Valider</button>
    </form>

</body>
</html>