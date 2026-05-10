<?= view('header/header', [
    'pageTitle' => 'Connexion utilisateur',
    'pageSubtitle' => 'Acces front office',
]) ?>

<section class="page-shell">
    <div class="container">
        <div class="auth-card p-4 p-lg-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <span class="section-tag mb-3"><i class="bi bi-box-arrow-in-right"></i> Connexion</span>
                    <h1 class="section-title fw-bold mb-3">Reprendre votre suivi regime en quelques secondes.</h1>
                    <p class="lead-copy mb-4">Accedez a votre profil, a votre portefeuille et a vos objectifs avec un ecran clair et moderne.</p>
                    <div class="soft-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box"><i class="bi bi-shield-lock"></i></div>
                            <div>
                                <div class="fw-semibold">Connexion securisee</div>
                                <div class="small-muted">Design propre, lisible et adapte au mobile.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <?php
                        if (!isset($firstUser) || !is_array($firstUser)) {
                            $firstUser = [];
                        }
                    ?>
                    <?php $loginError = (string) (session()->getFlashdata('error') ?? ''); ?>
                    <?php if ($loginError !== ''): ?>
                        <div class="status-box danger mb-3"><i class="bi bi-exclamation-triangle me-2"></i><?= esc($loginError) ?></div>
                    <?php endif; ?>
                    <form action="<?= site_url('/check-user') ?>" method="post" class="section-card">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="nom">Nom</label>
                                <input type="text" id="nom" name="nom" class="form-control" value="<?= esc((string) ($firstUser['nom'] ?? 'user')) ?>" required>
                            </div>
                            <div class="col-12">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control" value="<?= esc((string) ($firstUser['mot_de_passe'] ?? 'user123')) ?>" required>
                            </div>
                            <div class="col-12 d-flex flex-wrap gap-2 justify-content-end">
                                <a href="<?= site_url('/signin') ?>" class="btn btn-outline-secondary"><i class="bi bi-person-plus me-2"></i>Creer un compte</a>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-right-circle me-2"></i>Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>