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
        <pre><?php echo htmlentities(print_r($resultat, true)); ?></pre>
        
        <!-- Vue avec formulaire POST -->
        <form action="/export/pdf" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="data" value="<?= base64_encode(serialize($resultat)) ?>">
            <button type="submit">Exporter en PDF</button>
        </form>
        
    <?php else: ?>
        <p>Aucun résultat disponible.</p>
    <?php endif; ?>
</body>
</html>