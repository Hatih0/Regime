<?= view('header/header', [
    'pageTitle' => 'Dashboard',
    'pageSubtitle' => 'Tableau de bord de supervision',
]) ?>

<section class="hero-section">
    <div class="container position-relative py-4 py-lg-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="hero-badge mb-3"><i class="bi bi-speedometer2"></i> Tableau de bord</span>
                <h1 class="hero-title fw-bold mb-3">Vue d'ensemble du projet et acces rapide aux espaces principaux.</h1>
                <p class="hero-copy mb-4">Un ecran d'accueil admin plus lisible, plus premium et aligne avec le reste de l'application.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?= site_url('/only-admin') ?>" class="btn btn-primary btn-lg"><i class="bi bi-shield-check me-2"></i>Acces admin</a>
                    <a href="<?= site_url('/userAuth') ?>" class="btn btn-outline-dark btn-lg"><i class="bi bi-person-circle me-2"></i>Espace utilisateur</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-panel">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-box"><i class="bi bi-graph-up-arrow"></i></div>
                        <div>
                            <div class="fw-semibold">Statistiques visuelles</div>
                            <div class="small-muted">Tableaux, cartes et graphes a completer dans la logique metier.</div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="metric-box h-100">
                                <div class="metric-label">Regimes</div>
                                <div class="metric-value">5+</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="metric-box h-100">
                                <div class="metric-label">Activites</div>
                                <div class="metric-value">5+</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="metric-box h-100">
                                <div class="metric-label">Codes</div>
                                <div class="metric-value">15+</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="metric-box h-100">
                                <div class="metric-label">Utilisateurs</div>
                                <div class="metric-value">5+</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="page-shell">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stats-card h-100">
                    <div class="icon-box mb-3"><i class="bi bi-clipboard2-pulse"></i></div>
                    <h2 class="h5 fw-bold">Regimes</h2>
                    <p class="small-muted mb-0">CRUD, prix par duree et composition viande/poisson/volaille.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card h-100">
                    <div class="icon-box mb-3"><i class="bi bi-bicycle"></i></div>
                    <h2 class="h5 fw-bold">Activites sportives</h2>
                    <p class="small-muted mb-0">Gestion des activites associees aux variations de poids.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card h-100">
                    <div class="icon-box mb-3"><i class="bi bi-receipt"></i></div>
                    <h2 class="h5 fw-bold">Codes & portefeuille</h2>
                    <p class="small-muted mb-0">Validation des codes et suivi des rechargements utilisateurs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>