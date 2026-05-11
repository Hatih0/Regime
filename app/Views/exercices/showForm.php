<?= view('header/header', [
	'pageTitle' => isset($activite) ? 'Modifier une activité' : 'Créer une activité',
	'pageSubtitle' => 'CRUD des activités sportives',
]) ?>

<section class="page-shell">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<div class="section-card">
					<div class="d-flex justify-content-between align-items-center mb-4">
						<div>
							<span class="section-tag mb-2"><i class="bi bi-bicycle"></i> Activités</span>
							<h1 class="h3 fw-bold mb-0"><?= isset($activite) ? 'Modifier une activité sportive' : 'Créer une activité sportive' ?></h1>
						</div>
						<a href="<?= site_url('/exercices') ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Retour à la liste</a>
					</div>

					<form action="<?= isset($activite) ? site_url('/exercices/' . $activite['id'] . '/edit') : site_url('/exercices/create') ?>" method="post" class="split-grid two">
						<div>
							<label for="nom">Nom</label>
							<input type="text" id="nom" name="nom" value="<?= esc((string) ($activite['nom'] ?? '')) ?>" class="form-control" required>
						</div>
						<div>
							<label for="variation_poids">Variation de poids</label>
							<input type="number" step="0.01" id="variation_poids" name="variation_poids" value="<?= esc((string) ($activite['variation_poids'] ?? '')) ?>" class="form-control" required>
						</div>
						<div>
							<label for="duree">Durée</label>
							<input type="number" id="duree" name="duree" value="<?= esc((string) ($activite['duree'] ?? '')) ?>" class="form-control" required>
						</div>
						<div class="col-12 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary"><?= isset($activite) ? 'Mettre à jour' : 'Créer' ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<?= view('header/footer') ?>
