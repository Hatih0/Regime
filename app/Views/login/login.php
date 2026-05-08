<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <?php $firstUser = $firstUser ?? null; ?>

    <h1>Login Page</h1>
    <form action="<?= site_url('/check-user') ?>" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?= esc($firstUser['nom'] ?? 'user') ?>" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?= esc($firstUser['mot_de_passe'] ?? 'user123') ?>" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>