<?= view('header/header', [
    'pageTitle' => 'Administration',
    'pageSubtitle' => 'Authentification back office',
]) ?>

<section class="page-shell">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="auth-card p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <span class="section-tag mb-3"><i class="bi bi-shield-lock"></i> Back office</span>
                        <h1 class="section-title fw-bold mb-3">Connexion administrateur</h1>
                        <p class="lead-copy mb-0">Acces a la gestion des regimes, activites, codes et statistiques.</p>
                    </div>
                    <form action="<?= site_url('/adminAuth') ?>" method="post" class="section-card">
                        <?php if (!isset($firstAdmin) || !is_array($firstAdmin)) { $firstAdmin = []; } ?>
                        <div>
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= esc((string) ($firstAdmin['nom'] ?? 'admin')) ?>" required>
                        </div>
                        <div>
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control" value="<?= esc((string) ($firstAdmin['password'] ?? 'admin123')) ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right me-2"></i>Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>