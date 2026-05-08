<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form action="<?= site_url('/adminAuth') ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= esc($firstAdmin['nom'] ?? 'admin') ?>" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?= esc($firstAdmin['password'] ?? 'admin123') ?>" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>