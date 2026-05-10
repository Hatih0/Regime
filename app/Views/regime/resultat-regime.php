<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan régime</title>
</head>
<body>
    <h2>Résultat du calcul</h2>
    <?php if (isset($resultat)): ?>
        
        <?php if (!empty($resultat['message'])): ?>
            <p style="color: orange; font-weight: bold;"><?= htmlspecialchars($resultat['message']) ?></p>
        <?php else: ?>
            <div style="border: 1px solid #ddd; padding: 15px; margin: 10px 0; background: #f9f9f9;">
                <p><strong>Type de profil:</strong> <?= htmlspecialchars($resultat['choix']) ?></p>
                <p><strong>Objectif poids:</strong> <?= $resultat['variation_objectif'] > 0 ? '+' : '' ?><?= htmlspecialchars($resultat['variation_objectif']) ?> kg</p>
                <p><strong>Durée:</strong> <?= htmlspecialchars($resultat['nb_jours']) ?> jours</p>
                
                <div style="margin-top: 15px; padding: 10px; background: white; border: 2px solid #28a745;">
                    <p><strong>Prix:</strong> 
                        <?php if ($resultat['remise_gold'] ?? false): ?>
                            <span style="text-decoration: line-through;"><?= number_format($resultat['prix_total'] / 0.85, 2) ?></span> €
                            <span style="color: #28a745; font-weight: bold;">→ <?= number_format($resultat['prix_total'], 2) ?> €</span>
                            <span style="color: #28a745; font-weight: bold;">⭐ (-15% Gold)</span>
                        <?php else: ?>
                            <?= number_format($resultat['prix_total'], 2) ?> €
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Vue avec formulaire POST -->
        <form action="/export/pdf" method="POST" style="margin-top: 20px;">
            <?= csrf_field() ?>
            <input type="hidden" name="data" value="<?= base64_encode(serialize($resultat)) ?>">
            <button type="submit">Exporter en PDF</button>
        </form>
        
    <?php else: ?>
        <p>Aucun résultat disponible.</p>
    <?php endif; ?>
</body>
</html>