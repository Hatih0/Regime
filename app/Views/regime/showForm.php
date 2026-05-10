<?= view('header/header', [
    'pageTitle' => isset($regime) ? 'Modifier un régime' : 'Créer un régime',
    'pageSubtitle' => 'CRUD des régimes',
]) ?>

<section class="page-shell">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <span class="section-tag mb-2"><i class="bi bi-clipboard2-pulse"></i> Régimes</span>
                            <h1 class="h3 fw-bold mb-0"><?= isset($regime) ? 'Modifier un régime' : 'Créer un régime' ?></h1>
                        </div>
                        <a href="<?= site_url('/regimes') ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Retour à la liste</a>
                    </div>

                    <form action="<?= isset($regime) ? site_url('/regimes/' . $regime['id'] . '/edit') : site_url('/regimes/create') ?>" method="post" class="split-grid two">
                        <div>
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" value="<?= esc((string) ($regime['nom'] ?? '')) ?>" class="form-control" required>
                        </div>
                        <div>
                            <label for="pourcentage_viande">Pourcentage de viande</label>
                            <input type="number" id="pourcentage_viande" name="pourcentage_viande" value="<?= esc((string) ($regime['pourcentage_viande'] ?? '')) ?>" class="form-control" required>
                        </div>
                        <div>
                            <label for="pourcentage_poisson">Pourcentage de poisson</label>
                            <input type="number" id="pourcentage_poisson" name="pourcentage_poisson" value="<?= esc((string) ($regime['pourcentage_poisson'] ?? '')) ?>" class="form-control" required>
                        </div>
                        <div>
                            <label for="pourcentage_volaille">Pourcentage de volaille</label>
                            <input type="number" id="pourcentage_volaille" name="pourcentage_volaille" value="<?= esc((string) ($regime['pourcentage_volaille'] ?? '')) ?>" class="form-control" required>
                        </div>
                        <div>
                            <label for="variation_poids">Variation de poids</label>
                            <input type="number" id="variation_poids" name="variation_poids" value="<?= esc((string) ($regime['variation_poids'] ?? '')) ?>" class="form-control" required>
                        </div>
                        <div>
                            <label for="duree_jour">Durée en jours</label>
                            <input type="number" id="duree_jour" name="duree_jour" value="<?= esc((string) ($regime['duree_jour'] ?? '')) ?>" class="form-control" required>
                        </div>
                        <div>
                            <label for="prix">Prix</label>
                            <input type="number" id="prix" name="prix" value="<?= esc((string) ($regime['prix'] ?? '')) ?>" class="form-control" required>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><?= isset($regime) ? 'Mettre à jour' : 'Créer' ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>