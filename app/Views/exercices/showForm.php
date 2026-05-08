<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulaire exercice</title>
</head>
<body>

	<a href="<?= site_url('/exercices') ?>"><< Retour à la liste</a>

	<?php if (isset($activite)): ?>
		<h1>Modifier une activité sportive</h1>
		<form action="<?= site_url('/exercices/' . $activite['id'] . '/edit') ?>" method="post">
			<label for="nom">Nom:</label>
			<input type="text" id="nom" name="nom" value="<?= esc($activite['nom']) ?>" required><br><br>

			<label for="variation_poids">Variation de poids:</label>
			<input type="number" step="0.01" id="variation_poids" name="variation_poids" value="<?= esc($activite['variation_poids']) ?>" required><br><br>

			<label for="duree">Durée:</label>
			<input type="number" id="duree" name="duree" value="<?= esc($activite['duree']) ?>" required><br><br>

			<button type="submit">Mettre à jour</button>
		</form>
	<?php else: ?>
		<h1>Créer une activité sportive</h1>
		<form action="<?= site_url('/exercices/create') ?>" method="post">
			<label for="nom">Nom:</label>
			<input type="text" id="nom" name="nom" required><br><br>

			<label for="variation_poids">Variation de poids:</label>
			<input type="number" step="0.01" id="variation_poids" name="variation_poids" required><br><br>

			<label for="duree">Durée:</label>
			<input type="number" id="duree" name="duree" required><br><br>

			<button type="submit">Créer</button>
		</form>
	<?php endif; ?>

</body>
</html>
