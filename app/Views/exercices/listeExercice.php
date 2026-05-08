<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Liste des exercices</title>
</head>
<body>

	<a href="<?= site_url('/only-admin') ?>"><< Dashboard Admin</a>

	<h1>Liste des activités sportives</h1>

	<?php if (session()->getFlashdata('error')): ?>
		<p style="color: red;"><?= esc(session()->getFlashdata('error')) ?></p>
	<?php endif; ?>

	<?php if (empty($activites)): ?>
		<p>Aucune activité sportive trouvée.</p>
	<?php else: ?>
		<table border="1" cellpadding="8" cellspacing="0">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Variation Poids</th>
					<th>Durée</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($activites as $activite): ?>
					<tr>
						<td><?= esc($activite['nom']) ?></td>
						<td><?= esc($activite['variation_poids']) ?></td>
						<td><?= esc($activite['duree']) ?></td>
						<td>
							<a href="<?= site_url('/exercices/' . $activite['id'] . '/view') ?>">Modifier</a>
							<a href="<?= site_url('/exercices/' . $activite['id'] . '/delete') ?>">Supprimer</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

	<button><a href="<?= site_url('/exercices/showForm') ?>">Ajouter une activité</a></button>

</body>
</html>
