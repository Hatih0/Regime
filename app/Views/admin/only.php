<?= view('header/header', [
    'pageTitle' => 'Administration',
    'pageSubtitle' => 'Gestion rapide du back office',
]) ?>

<section class="page-shell">
    <div class="container">
        <div class="auth-card p-4 p-lg-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <span class="section-tag mb-3"><i class="bi bi-shield-check"></i> Back office</span>
                    <h1 class="section-title fw-bold mb-3">Acces rapide aux modules admin</h1>
                    <p class="lead-copy mb-0">Utilisez ce hub pour naviguer entre les regimes, les exercices, le dashboard et la deconnexion.</p>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a class="soft-card text-decoration-none d-block h-100" href="<?= site_url('/regimes') ?>">
                                <div class="icon-box mb-3"><i class="bi bi-clipboard2-pulse"></i></div>
                                <div class="fw-semibold text-dark">Regimes</div>
                                <div class="small-muted">Liste, creation, edition et suppression.</div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a class="soft-card text-decoration-none d-block h-100" href="<?= site_url('/exercices') ?>">
                                <div class="icon-box mb-3"><i class="bi bi-bicycle"></i></div>
                                <div class="fw-semibold text-dark">Exercices</div>
                                <div class="small-muted">Gestion des activites sportives associees.</div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a class="soft-card text-decoration-none d-block h-100" href="<?= site_url('/dashboard') ?>">
                                <div class="icon-box mb-3"><i class="bi bi-speedometer2"></i></div>
                                <div class="fw-semibold text-dark">Dashboard</div>
                                <div class="small-muted">Retour au tableau de bord principal.</div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a class="soft-card text-decoration-none d-block h-100" href="<?= site_url('/admin/logout') ?>">
                                <div class="icon-box mb-3"><i class="bi bi-box-arrow-right"></i></div>
                                <div class="fw-semibold text-dark">Deconnexion</div>
                                <div class="small-muted">Fermer la session administrateur.</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>