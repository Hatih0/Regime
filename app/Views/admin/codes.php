<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Codes de rechargement</title>
</head>
<body>
    <h1>Codes de rechargement</h1>

    <h2>Générer des codes</h2>
    <form method="post" action="/admin/codes/generate">
        <label>Nombre de codes: <input type="number" name="count" value="5" required></label>
        <label>Montant (€): <input type="number" step="0.01" name="montant" value="10.00" required></label>
        <button type="submit">Générer</button>
    </form>

    <h2>Liste des codes</h2>
    <table border="1" cellpadding="6">
        <thead><tr><th>ID</th><th>Code</th><th>Montant</th><th>Status</th></tr></thead>
        <tbody>
        <?php foreach ($codes as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= $c['code'] ?></td>
                <td><?= number_format($c['montant'],2) ?> €</td>
                <td><?= $c['status'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="/only-admin">Retour tableau de bord</a></p>
</body>
</html>
