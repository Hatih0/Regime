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
        <input type="number" name="id_utilisateur" id="id_utilisateur" placeholder="ID Utilisateur" required>
        <br><br>

        <label>Sélectionnez votre objectif :</label><br>
        <input type="radio" name="id_objectif" value="1" id="objectif_1">
        <label for="objectif_1">Prise de masse musculaire</label><br>
        
        <input type="radio" name="id_objectif" value="2" id="objectif_2" checked>
        <label for="objectif_2">Perte de poids</label><br>
        
        <input type="radio" name="id_objectif" value="3" id="objectif_3">
        <label for="objectif_3">Atteindre mon IMC idéal</label><br>
        <br>

        <label for="poids">Valeur cible :</label><br>
        <input type="number" name="poids" id="poids" step="0.1" required value="10">
        <span id="unite">kg</span>
        <br><br>

        <button type="submit">Valider</button>
    </form>

    <script>
        const radioPoids = document.getElementById('objectif_1');
        const radioImc = document.getElementById('objectif_3');
        const inputPoids = document.getElementById('poids');
        const spanUnite = document.getElementById('unite');

        function updateInputBasedOnObjective() {
            if (radioPoids.checked) {
                inputPoids.value = 10;
                spanUnite.textContent = 'kg';
            } else if (radioImc.checked) {
                inputPoids.value = 22.0;
                spanUnite.textContent = 'kg/m²';
            } else {
                inputPoids.value = 10;
                spanUnite.textContent = 'kg';
            }
        }

        document.querySelectorAll('input[name="id_objectif"]').forEach(radio => {
            radio.addEventListener('change', updateInputBasedOnObjective);
        });

        // Initialiser au chargement
        updateInputBasedOnObjective();
    </script>
</body>
</html>