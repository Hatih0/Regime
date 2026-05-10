<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Portefeuille</title>
</head>
<body>
    <h1>Mon Portefeuille</h1>
    <p>Solde actuel: <?= isset($portefeuille['solde']) ? number_format($portefeuille['solde'],2) : '0.00' ?> €</p>

    <?php if (session()->getFlashdata('success')): ?>
        <div style="color:green"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div style="color:red"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <h2>Recharger avec un code</h2>
    <form method="post" action="/wallet/recharge">
        <label>Code: <input type="text" name="code" required></label>
        <button type="submit">Recharger</button>
    </form>

    <p><a href="/user-profile">Retour au profil</a></p>
</body>
</html>
