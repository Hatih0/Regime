<?= view('header/header', [
    'pageTitle' => 'Codes générés',
    'pageSubtitle' => 'Resultat de la génération',
]) ?>

<section class="page-shell">
    <div class="container">
        <?php if (!isset($codes) || !is_array($codes)) { $codes = []; } ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-card">
                    <span class="section-tag mb-3"><i class="bi bi-check2-circle"></i> Génération réussie</span>
                    <h1 class="h3 fw-bold mb-3">Codes générés</h1>
                    <p class="lead-copy mb-4">Copiez-les et partagez-les avec les utilisateurs pour leurs recharges.</p>
                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr><th>Code</th><th>Montant</th></tr>
                                </thead>
                                <tbody>
                                <?php foreach ($codes as $c): ?>
                                    <tr>
                                        <td class="fw-semibold"><?= $c['code'] ?></td>
                                        <td><?= number_format($c['montant'], 2) ?> €</td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="/admin/codes" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Retour</a>
                        <a href="/only-admin" class="btn btn-primary"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>
