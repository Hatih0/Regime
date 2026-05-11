<?= view('header/header', [
	'pageTitle' => 'Liste des activités',
	'pageSubtitle' => 'Gestion du sport associé aux régimes',
]) ?>

<section class="page-shell">
	<div class="container">
		<?php if (!isset($activites) || !is_array($activites)) { $activites = []; } ?>
		<div class="section-card">
			<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
				<div>
					<span class="section-tag mb-2"><i class="bi bi-bicycle"></i> Activités</span>
					<h1 class="h3 fw-bold mb-0">Liste des activités sportives</h1>
				</div>
				<div class="d-flex gap-2">
					<a href="<?= site_url('/only-admin') ?>" class="btn btn-outline-secondary"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
					<a href="<?= site_url('/exercices/showForm') ?>" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Ajouter une activité</a>
				</div>
			</div>

			<?php if (session()->getFlashdata('error')): ?>
				<div class="status-box danger mb-3"><?= esc((string) session()->getFlashdata('error')) ?></div>
			<?php endif; ?>

			<?php if (empty($activites)): ?>
				<div class="status-box warning">Aucune activité sportive trouvée.</div>
			<?php else: ?>
				<div class="table-responsive table-card">
					<table class="table align-middle mb-0">
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
									<td class="fw-semibold"><?= esc((string) $activite['nom']) ?></td>
									<td><?= esc((string) $activite['variation_poids']) ?></td>
									<td><?= esc((string) $activite['duree']) ?></td>
									<td>
										<div class="d-flex flex-wrap gap-2">
											<a href="<?= site_url('/exercices/' . $activite['id'] . '/view') ?>" class="action-chip"><i class="bi bi-pencil me-1"></i>Modifier</a>
											<a href="<?= site_url('/exercices/' . $activite['id'] . '/delete') ?>" class="action-chip"><i class="bi bi-trash me-1"></i>Supprimer</a>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?= view('header/footer') ?>
