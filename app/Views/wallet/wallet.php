<?= view('header/header', [
    'pageTitle' => 'Portefeuille',
    'pageSubtitle' => 'Recharge et suivi du solde',
]) ?>

<section class="page-shell">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-card">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div>
                            <span class="section-tag mb-2"><i class="bi bi-wallet2"></i> Portefeuille</span>
                            <h1 class="h3 fw-bold mb-0">Mon portefeuille</h1>
                        </div>
                        <div class="status-box success mb-0">
                            <div class="small-muted">Solde actuel</div>
                            <div class="metric-value mb-0"><?= isset($portefeuille['solde']) ? number_format($portefeuille['solde'], 2) : '0.00' ?> €</div>
                        </div>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="status-box success mb-3"><i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="status-box danger mb-3"><i class="bi bi-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <div class="row g-4 align-items-stretch">
                        <div class="col-md-5">
                            <div class="soft-card h-100">
                                <div class="icon-box mb-3"><i class="bi bi-cash-coin"></i></div>
                                <h2 class="h5 fw-bold">Recharge par code</h2>
                                <p class="small-muted mb-0">Saisissez un code de rechargement valide pour approvisionner instantanement votre solde.</p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form method="post" action="<?= site_url('/wallet/recharge') ?>" class="section-card h-100">
                                <div>
                                    <label for="code">Code</label>
                                    <input type="text" id="code" name="code" class="form-control" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-repeat me-2"></i>Recharger</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="<?= site_url('/user-profile') ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Retour au profil</a>
                        <a href="<?= site_url('/gold') ?>" class="btn btn-primary"><i class="bi bi-gem me-2"></i>Decouvrir Gold</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>
