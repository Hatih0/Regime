<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Option Gold</title>
</head>
<body>
    <h1>Option Gold Premium</h1>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div style="color:red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if ($user && (bool) $user['gold']): ?>
        <div style="color:green; padding: 10px; border: 1px solid green; margin-bottom: 10px;">
            ✓ Vous avez l'option Gold active ! Remise de 15% sur tous les régimes.
        </div>
    <?php else: ?>
        <div style="background: #f0f0f0; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h2>Bénéfices Gold</h2>
            <ul>
                <li><strong>15% de remise</strong> sur TOUS les régimes</li>
                <li><strong>Économies</strong> sur vos achats de plans alimentaires</li>
                <li><strong>Accès premium</strong> à titre illimité</li>
            </ul>

            <h2>Prix : <?= number_format(99.99, 2) ?> €</h2>
            
            <p><strong>Votre solde actuel : <?= number_format($solde, 2) ?> €</strong></p>

            <?php if ($solde >= 99.99): ?>
                <form method="post" action="/buy-gold" style="margin-top: 20px;">
                    <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                        Acheter l'option Gold
                    </button>
                </form>
            <?php else: ?>
                <div style="color: red; margin-top: 20px;">
                    ⚠ Solde insuffisant. Il vous manque <?= number_format(99.99 - $solde, 2) ?> €
                </div>
                <p><a href="/wallet">Recharger votre portefeuille</a></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <p><a href="/user-profile">Retour au profil</a></p>
</body>
</html>
