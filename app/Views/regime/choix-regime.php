<?= view('header/header', [
    'pageTitle' => 'Choix de regime',
    'pageSubtitle' => 'Selection et calcul du plan',
]) ?>

<section class="page-shell">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-card">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-5">
                            <span class="section-tag mb-3"><i class="bi bi-clipboard2-pulse"></i> Regime</span>
                            <h1 class="section-title fw-bold mb-3">Choisissez le profil de regime et l'activite associee.</h1>
                            <p class="lead-copy mb-0">Le formulaire prépare le calcul du plan alimentaire et du niveau d'effort sportif.</p>
                        </div>
                        <div class="col-lg-7">
                            <form action="calcul-regime" method="post" class="section-card">
                                <div>
                                    <label class="d-block mb-2">Votre option</label>
                                    <div class="d-grid gap-2">
                                        <div class="form-check p-3 border rounded-4 bg-white">
                                            <input type="radio" name="regime" id="regime1" value="rapide" checked class="form-check-input">
                                            <label for="regime1" class="form-check-label ms-2">Rapide +</label>
                                        </div>
                                        <div class="form-check p-3 border rounded-4 bg-white">
                                            <input type="radio" name="regime" id="regime2" value="economique" class="form-check-input">
                                            <label for="regime2" class="form-check-label ms-2">Economique +</label>
                                        </div>
                                        <div class="form-check p-3 border rounded-4 bg-white">
                                            <input type="radio" name="regime" id="regime3" value="sportif" class="form-check-input">
                                            <label for="regime3" class="form-check-label ms-2">Sportif +</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-right-circle me-2"></i>Soumettre</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>