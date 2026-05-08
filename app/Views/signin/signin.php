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
        <input type="text" name="nom" id="nom" placeholder="Nom" required><br>
        <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" required><br>
        <select name="genre" id="genre" required>
            <option value="">Select Genre</option>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
            <option value="Autre">Autre</option>
        </select>
        <br>
        <br>
        <input type="number" name="poids" id="poids" min="0" max="300" placeholder="poids en kg"><br>
        <input type="number" name="taille" id="taille" min="0" max="250" placeholder="taille en cm"><br>
        <button type="submit">Sign In</button>
    </form>

</body>
</html>