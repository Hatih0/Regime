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

                    <?php if (!empty($errorMessage)): ?>
                        <div class="status-box danger mb-4"><i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($errorMessage) ?></div>
                    <?php endif; ?>

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

                        <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                            <form action="<?= site_url('/export/pdf') ?>" method="POST">
                                <?= csrf_field() ?>
                                <input type="hidden" name="data" value="<?= base64_encode(serialize($resultat)) ?>">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-filetype-pdf me-2"></i>Exporter en PDF</button>
                            </form>

                            <?php if (empty($resultat['message']) && !empty($resultat['meilleure'])): ?>
                                <form action="<?= site_url('/acheter-regime') ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="data" value="<?= base64_encode(serialize($resultat)) ?>">
                                    <button type="submit" class="btn btn-success"><i class="bi bi-bag-check me-2"></i>Acheter le régime</button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($resultat['meilleure'])): ?>
                            <div class="section-card mt-4">
                                <span class="section-tag mb-3"><i class="bi bi-list-check"></i> Détails du plan</span>
                                <h2 class="h5 mb-3">Régimes sélectionnés</h2>

                                <div class="table-responsive mb-3">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Régime</th>
                                                <th>Viande</th>
                                                <th>Poisson</th>
                                                <th>Volaille</th>
                                                <th>Var./jour</th>
                                                <th>Durée (jours)</th>
                                                <th>Prix total</th>
                                                <th>Prix / jour</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($resultat['meilleure']['regimes'] as $regime):
                                                $prix = floatval($regime['prix'] ?? 0);
                                                $duree = max(1, intval($regime['duree_jour'] ?? ($regime['duree_jour'] ?? 1)));
                                                $prix_jour = $prix / $duree;
                                            ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($regime['nom'] ?? '—') ?></td>
                                                    <td><?= number_format($regime['pourcentage_viande'] ?? 0, 2) ?>%</td>
                                                    <td><?= number_format($regime['pourcentage_poisson'] ?? 0, 2) ?>%</td>
                                                    <td><?= number_format($regime['pourcentage_volaille'] ?? 0, 2) ?>%</td>
                                                    <td><?= number_format($regime['variation_poids'] ?? 0, 2) ?> kg</td>
                                                    <td><?= $duree ?></td>
                                                    <td><?= number_format($prix, 2) ?> €</td>
                                                    <td><?= number_format($prix_jour, 2) ?> €</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php if (!empty($resultat['meilleure']['activites'])): ?>
                                    <h3 class="h6 mt-3">Activités recommandées</h3>
                                    <ul class="list-group mb-2">
                                        <?php foreach ($resultat['meilleure']['activites'] as $act): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong><?= htmlspecialchars($act['nom'] ?? 'Activité') ?></strong>
                                                    <div class="small-muted">Variation/jour: <?= number_format($act['variation_poids'] ?? 0, 3) ?> kg</div>
                                                </div>
                                                <span class="badge bg-secondary rounded-pill">Durée: <?= intval($act['duree'] ?? 0) ?>h/sem</span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="status-box warning">Aucun résultat disponible.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>