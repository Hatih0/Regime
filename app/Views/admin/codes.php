<?= view('header/header', [
    'pageTitle' => 'Codes de rechargement',
    'pageSubtitle' => 'Gestion des codes et recharges',
]) ?>

<section class="page-shell">
    <div class="container">
        <?php if (!isset($codes) || !is_array($codes)) { $codes = []; } ?>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="section-card h-100">
                    <span class="section-tag mb-3"><i class="bi bi-upc-scan"></i> Codes</span>
                    <h1 class="h3 fw-bold mb-3">Generer des codes de rechargement</h1>
                    <p class="lead-copy mb-0">Contrôle simple des montants et du volume de codes à créer pour alimenter le portefeuille.</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="section-card mb-4">
                    <h2 class="h5 fw-bold mb-3">Générer des codes</h2>
                    <form method="post" action="/admin/codes/generate" class="split-grid two">
                        <div>
                            <label>Nombre de codes</label>
                            <input type="number" name="count" value="5" required class="form-control">
                        </div>
                        <div>
                            <label>Montant (€)</label>
                            <input type="number" step="0.01" name="montant" value="10.00" required class="form-control">
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Générer</button>
                        </div>
                    </form>
                </div>

                <div class="table-card">
                    <h2 class="h5 fw-bold mb-3">Liste des codes</h2>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr><th>ID</th><th>Code</th><th>Montant</th><th>Status</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($codes as $c): ?>
                                <tr>
                                    <td><?= $c['id'] ?></td>
                                    <td class="fw-semibold"><?= $c['code'] ?></td>
                                    <td><?= number_format($c['montant'], 2) ?> €</td>
                                    <td><span class="badge <?= $c['status'] === 'valide' ? 'badge-soft-primary' : 'badge-soft-danger' ?> rounded-pill"><?= $c['status'] ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="/only-admin" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Retour tableau de bord</a>
                    <a href="/admin/logout" class="btn btn-outline-dark"><i class="bi bi-box-arrow-right me-2"></i>Deconnexion</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>
