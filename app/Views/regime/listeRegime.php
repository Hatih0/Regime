<?= view('header/header', [
    'pageTitle' => 'Liste des régimes',
    'pageSubtitle' => 'Gestion des plans alimentaires',
]) ?>

<section class="page-shell">
    <div class="container">
        <?php if (!isset($regimes) || !is_array($regimes)) { $regimes = []; } ?>
        <div class="section-card">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <span class="section-tag mb-2"><i class="bi bi-clipboard2-pulse"></i> Régimes</span>
                    <h1 class="h3 fw-bold mb-0">Liste des régimes</h1>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= site_url('/only-admin') ?>" class="btn btn-outline-secondary"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                    <a href="<?= site_url('/regimes/showForm') ?>" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Ajouter un régime</a>
                </div>
            </div>

            <?php if (empty($regimes)): ?>
                <div class="status-box warning">Aucun régime trouvé.</div>
            <?php else: ?>
                <div class="table-responsive table-card">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Viande</th>
                                <th>Poisson</th>
                                <th>Volaille</th>
                                <th>Variation</th>
                                <th>Durée</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($regimes as $regime): ?>
                                <tr>
                                    <td class="fw-semibold"><?= esc((string) $regime['nom']) ?></td>
                                    <td><?= esc((string) $regime['pourcentage_viande']) ?> %</td>
                                    <td><?= esc((string) $regime['pourcentage_poisson']) ?> %</td>
                                    <td><?= esc((string) $regime['pourcentage_volaille']) ?> %</td>
                                    <td><?= esc((string) $regime['variation_poids']) ?></td>
                                    <td><?= esc((string) $regime['duree_jour']) ?></td>
                                    <td><?= esc((string) $regime['prix']) ?></td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="<?= site_url('/regimes/' . $regime['id']) . '/view' ?>" class="action-chip"><i class="bi bi-pencil me-1"></i>Modifier</a>
                                            <a href="<?= site_url('/regimes/' . $regime['id']) . '/delete' ?>" class="action-chip"><i class="bi bi-trash me-1"></i>Supprimer</a>
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