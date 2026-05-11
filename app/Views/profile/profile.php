<?php
    if (!isset($user) || !is_array($user)) {
        $user = [];
    }
    if (!isset($objectifsInfos) || !is_array($objectifsInfos)) {
        $objectifsInfos = [];
    }
    if (!isset($santeInfos) || !is_array($santeInfos)) {
        $santeInfos = [];
    }
    $imc = isset($imc) ? (float) $imc : 0.0;
    $gold_inf = $user['gold'] == 1 ? "Vous êtes abonné à l'offre gold" : "Vous n'êtes pas abonné à l'offre gold";
    $objectifLabels = [1 => 'Prise de masse musculaire', 2 => 'Perte de poids', 3 => 'Atteindre mon IMC idéal'];
    $hasObjectif = !empty($objectifsInfos) && isset($objectifsInfos[0]);
    $mon_objectif = $hasObjectif ? ($objectifLabels[$objectifsInfos[0]['id_objectif']] ?? 'Objectif inconnu') : "Aucun objectif";
    $dateInsc = !empty($user['date_inscription']) ? date('d/m/Y', strtotime($user['date_inscription'])) : 'N/A';
    $sante = $santeInfos[0] ?? [];
    $dateMesure = !empty($sante['date_mesure']) ? date('d/m/Y H:i', strtotime($sante['date_mesure'])) : 'N/A';
    $dateObjectif = $hasObjectif ? date('d/m/Y', strtotime($objectifsInfos[0]['date_choix'])) : null;
    $imcFormatted = number_format((float) $imc, 2, ',', ' ');
?>

<?= view('header/header', [
    'pageTitle' => 'Mon profil',
    'pageSubtitle' => 'Suivi IMC et objectifs',
]) ?>

<section class="page-shell">
    <div class="container-fluid">
        <div class="container-lg">
            <div class="row g-4">
            <div class="col-lg-4">
                <div class="glass-card h-100">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <span class="section-tag mb-2"><i class="bi bi-person-circle"></i> Profil</span>
                            <h1 class="h3 fw-bold mb-1"><?= htmlspecialchars($user['nom']) ?></h1>
                            <div class="small-muted">Membre depuis le <?= $dateInsc ?></div>
                        </div>
                        <span class="badge badge-soft-primary rounded-pill px-3 py-2">IMC <?= $imcFormatted ?></span>
                    </div>

                    <div class="status-box <?= (bool) ($user['gold'] ?? false) ? 'success' : 'warning' ?> mb-3">
                        <i class="bi bi-gem me-2"></i><?= $gold_inf ?>
                    </div>

                    <div class="metric-grid">
                        <div class="metric-box">
                            <div class="metric-label">Taille</div>
                            <div class="metric-value"><?= htmlspecialchars($sante['taille'] ?? '0') ?> cm</div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Poids</div>
                            <div class="metric-value"><?= htmlspecialchars($sante['poids'] ?? '0') ?> kg</div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Derniere mesure</div>
                            <div class="metric-value fs-6"><?= $dateMesure ?></div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Objectif</div>
                            <div class="metric-value fs-6"><?= htmlspecialchars($mon_objectif) ?></div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <a href="<?= site_url('/wallet') ?>" class="btn btn-outline-primary"><i class="bi bi-wallet2 me-2"></i>Mon portefeuille</a>
                        <a href="<?= site_url('/gold') ?>" class="btn btn-primary"><i class="bi bi-gem me-2"></i>Option Gold</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="section-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="section-tag mb-2"><i class="bi bi-heart-pulse"></i> Sante</span>
                            <h2 class="h4 fw-bold mb-0">Mes informations de santé actuelles</h2>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="soft-card h-100">
                                <div class="small-muted">Taille</div>
                                <div class="metric-value"><?= htmlspecialchars($sante['taille'] ?? '0') ?> cm</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="soft-card h-100">
                                <div class="small-muted">Poids</div>
                                <div class="metric-value"><?= htmlspecialchars($sante['poids'] ?? '0') ?> kg</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="soft-card h-100">
                                <div class="small-muted">IMC</div>
                                <div class="metric-value"><?= $imcFormatted ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="section-tag mb-2"><i class="bi bi-bullseye"></i> Objectif</span>
                            <h2 class="h4 fw-bold mb-0">Mon objectif actuel</h2>
                        </div>
                    </div>
                    <?php if ($hasObjectif): ?>
                        <div class="status-box success mb-3"><i class="bi bi-check-circle me-2"></i>Objectif pose le <?= $dateObjectif ?></div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="soft-card h-100">
                                    <div class="small-muted">Type</div>
                                    <div class="fw-semibold"><?= htmlspecialchars($mon_objectif) ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="soft-card h-100">
                                    <div class="small-muted">Valeur cible</div>
                                    <div class="fw-semibold"><?= htmlspecialchars($objectifsInfos[0]['poids']) ?></div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="status-box warning mb-3"><i class="bi bi-info-circle me-2"></i>Vous n'avez pas encore pose d'objectif.</div>
                    <?php endif; ?>
                </div>

                <div class="split-grid two">
                    <div class="section-card">
                        <h2 class="h5 fw-bold mb-3">Nouvelle mesure</h2>
                        <form action="<?= site_url('/update-sante') ?>" method="post">
                            <div>
                                <label>Poids (kg)</label>
                                <input type="number" name="poids" step="0.1" class="form-control" required>
                            </div>
                            <div>
                                <label>Taille (cm)</label>
                                <input type="number" name="taille" step="0.1" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-2"></i>Valider</button>
                        </form>
                    </div>

                    <div class="section-card">
                        <h2 class="h5 fw-bold mb-3">Nouvel objectif</h2>
                        <form action="<?= site_url('/update-objectif') ?>" method="post">
                            <div>
                                <label class="d-block mb-2">Objectif</label>
                                <div class="d-grid gap-2">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="id_objectif" value="1" id="obj_1">
                                        <label for="obj_1" class="form-check-label">Prise de masse musculaire</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="id_objectif" value="2" id="obj_2" checked>
                                        <label for="obj_2" class="form-check-label">Perte de poids</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="id_objectif" value="3" id="obj_3">
                                        <label for="obj_3" class="form-check-label">Atteindre mon IMC idéal</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="objectif_valeur">Valeur cible</label>
                                <input type="number" name="poids" id="objectif_valeur" step="0.1" value="10" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-bullseye me-2"></i>Valider</button>
                        </form>
                    </div>
                </div>

                <div class="section-card mt-4">
                    <h2 class="h5 fw-bold mb-3">Informations personnelles</h2>
                    <form action="<?= site_url('/update-utilisateur') ?>" method="post" class="split-grid two">
                        <div>
                            <label>Nom</label>
                            <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" class="form-control" required>
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="d-block mb-2">Genre</label>
                            <div class="pill-list">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="genre" value="Homme" id="gen_h" <?= $user['genre'] === 'Homme' ? 'checked' : '' ?>>
                                    <label for="gen_h" class="form-check-label">Homme</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="genre" value="Femme" id="gen_f" <?= $user['genre'] === 'Femme' ? 'checked' : '' ?>>
                                    <label for="gen_f" class="form-check-label">Femme</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="genre" value="Autre" id="gen_a" <?= $user['genre'] === 'Autre' ? 'checked' : '' ?>>
                                    <label for="gen_a" class="form-check-label">Autre</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('input[name="id_objectif"]').forEach((radio) => {
        radio.addEventListener('change', function () {
            const valeur = document.getElementById('objectif_valeur');
            valeur.value = this.value === '3' ? 22.0 : 10;
        });
    });
</script>

<?= view('header/footer') ?>