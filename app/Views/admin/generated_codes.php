<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Codes générés</title>
</head>
<body>
    <h1>Codes générés</h1>
    <p>Copiez-les et partagez-les avec les utilisateurs :</p>
    <ul>
    <?php foreach ($codes as $c): ?>
        <li><?= $c['code'] ?> — <?= number_format($c['montant'],2) ?> €</li>
    <?php endforeach; ?>
    </ul>

    <p><a href="/admin/codes">Retour</a></p>
</body>
</html>
