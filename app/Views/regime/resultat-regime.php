<?= view('header/header', [
    'pageTitle' => 'Résultat du régime',
    'pageSubtitle' => 'Synthèse du calcul',
]) ?>

<section class="page-shell">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="section-card">
                    <span class="section-tag mb-3"><i class="bi bi-file-earmark-bar-graph"></i> Résultat</span>
                    <h1 class="h3 fw-bold mb-4">Résultat du calcul</h1>

                    <?php if (isset($resultat)): ?>
                        <?php if (!empty($resultat['message'])): ?>
                            <div class="status-box warning mb-4"><i class="bi bi-info-circle me-2"></i><?= htmlspecialchars($resultat['message']) ?></div>
                        <?php else: ?>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div class="metric-box h-100">
                                        <div class="metric-label">Type de profil</div>
                                        <div class="metric-value fs-5"><?= htmlspecialchars($resultat['choix']) ?></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="metric-box h-100">
                                        <div class="metric-label">Objectif poids</div>
                                        <div class="metric-value fs-5"><?= $resultat['variation_objectif'] > 0 ? '+' : '' ?><?= htmlspecialchars($resultat['variation_objectif']) ?> kg</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="metric-box h-100">
                                        <div class="metric-label">Durée</div>
                                        <div class="metric-value fs-5"><?= htmlspecialchars($resultat['nb_jours']) ?> jours</div>
                                    </div>
                                </div>
                            </div>

                            <div class="status-box success mb-4">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                                    <div>
                                        <div class="small-muted">Prix du plan</div>
                                        <div class="fw-bold fs-4">
                                            <?php if ($resultat['remise_gold'] ?? false): ?>
                                                <span class="text-decoration-line-through text-muted"><?= number_format($resultat['prix_total'] / 0.85, 2) ?> €</span>
                                                <span class="ms-2"><?= number_format($resultat['prix_total'], 2) ?> €</span>
                                            <?php else: ?>
                                                <?= number_format($resultat['prix_total'], 2) ?> €
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ($resultat['remise_gold'] ?? false): ?>
                                        <span class="badge badge-soft-warning rounded-pill px-3 py-2">Gold -15%</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form action="/export/pdf" method="POST" class="d-flex justify-content-end">
                            <?= csrf_field() ?>
                            <input type="hidden" name="data" value="<?= base64_encode(serialize($resultat)) ?>">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-filetype-pdf me-2"></i>Exporter en PDF</button>
                        </form>
                    <?php else: ?>
                        <div class="status-box warning">Aucun résultat disponible.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>