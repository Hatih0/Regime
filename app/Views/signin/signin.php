<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
</head>
<body>
    <h1>Sign In</h1>
    <form action="/create-user" method="post">
        <!-- ETAPE 1 : Infos de base -->
        <div id="etape1">
            <h2>Informations personnelles</h2>
            <input type="text" name="nom" id="nom" placeholder="Nom" required><br>
            <input type="email" name="email" id="email" placeholder="Email" required><br>
            <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" required><br>
            
            <label>Genre :</label><br>
            <input type="radio" name="genre" value="Homme" id="genre_homme" required checked>
            <label for="genre_homme">Homme</label><br>
            <input type="radio" name="genre" value="Femme" id="genre_femme">
            <label for="genre_femme">Femme</label><br>
            <input type="radio" name="genre" value="Autre" id="genre_autre">
            <label for="genre_autre">Autre</label><br>
            <br>
            <button type="button" id="btnContinuer">Continuer</button>
        </div>

        <!-- ETAPE 2 : Poids et taille -->
        <div id="etape2" style="display:none;">
            <h2>Mesures physiques</h2>
            <input type="number" name="poids" id="poids" min="0" max="300" placeholder="Poids en kg" step="0.1" required><br>
            <input type="number" name="taille" id="taille" min="0" max="250" placeholder="Taille en cm" step="0.1" required><br>
            <br>
            <button type="submit">Créer mon compte</button>
        </div>
    </form>
    
    <script>
        document.getElementById('btnContinuer').addEventListener('click', function() {
            const nom = document.getElementById('nom').value.trim();
            const email = document.getElementById('email').value.trim();
            const mot_de_passe = document.getElementById('mot_de_passe').value.trim();
            const genre = document.querySelector('input[name="genre"]:checked').value;

            if (nom && email && mot_de_passe && genre) {
                document.getElementById('etape1').style.display = 'none';
                document.getElementById('etape2').style.display = 'block';
            } else {
                alert('Veuillez remplir tous les champs');
            }
        });
    </script>
</body>
</html>