<?= view('header/header', [
    'pageTitle' => 'Profil utilisateur',
    'pageSubtitle' => 'Synthese rapide du compte',
]) ?>

<section class="page-shell">
    <div class="container">
        <?php if (!isset($user) || !is_array($user)) { $user = []; } ?>
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-card">
                    <span class="section-tag mb-3"><i class="bi bi-person-badge"></i> Profil</span>
                    <h1 class="h3 fw-bold mb-4">Profil utilisateur</h1>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="metric-box h-100">
                                <div class="metric-label">Nom</div>
                                <div class="metric-value fs-5"><?= htmlspecialchars($user['nom']) ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="metric-box h-100">
                                <div class="metric-label">Date d'inscription</div>
                                <div class="metric-value fs-5"><?= htmlspecialchars($user['date_inscription']) ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="metric-box h-100">
                                <div class="metric-label">Genre</div>
                                <div class="metric-value fs-5"><?= htmlspecialchars($user['genre']) ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="metric-box h-100">
                                <div class="metric-label">Gold</div>
                                <div class="metric-value fs-5"><?= !empty($user['gold']) ? 'Oui' : 'Non' ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>