<?= view('header/header', [
    'pageTitle' => 'Inscription',
    'pageSubtitle' => 'Creation de compte en deux etapes',
]) ?>

<section class="page-shell auth-fullscreen">
    <div class="container-fluid">
        <div class="container-xxl">
            <div class="auth-card auth-card-wide p-4 p-lg-5">
            <div class="row g-4 align-items-start">
                <div class="col-lg-5">
                    <span class="section-tag mb-3"><i class="bi bi-person-plus"></i> Nouveau compte</span>
                    <h1 class="section-title fw-bold mb-3">Renseignez votre profil pour personnaliser les recommandations.</h1>
                    <p class="lead-copy mb-4">L'inscription est scindee en deux pages logiques: les informations personnelles d'abord, puis les mesures de sante.</p>
                    <div class="pill-list">
                        <span class="pill">Nom</span>
                        <span class="pill">Email</span>
                        <span class="pill">Genre</span>
                        <span class="pill">Taille</span>
                        <span class="pill">Poids</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="<?= site_url('/create-user') ?>" method="post" class="section-card">
                        <div id="etape1" class="split-grid two">
                            <div class="col-12">
                                <h2 class="h4 fw-bold mb-3">Informations personnelles</h2>
                            </div>
                            <div>
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required>
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-12">
                                <label for="mot_de_passe">Mot de passe</label>
                                <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
                            </div>
                            <div class="col-12">
                                <label class="d-block mb-2">Genre</label>
                                <div class="pill-list">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genre" value="Homme" id="genre_homme" required checked>
                                        <label class="form-check-label" for="genre_homme">Homme</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genre" value="Femme" id="genre_femme">
                                        <label class="form-check-label" for="genre_femme">Femme</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genre" value="Autre" id="genre_autre">
                                        <label class="form-check-label" for="genre_autre">Autre</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" id="btnContinuer" class="btn btn-primary"><i class="bi bi-arrow-right me-2"></i>Continuer</button>
                            </div>
                        </div>

                        <div id="etape2" class="split-grid two d-none mt-2">
                            <div class="col-12">
                                <h2 class="h4 fw-bold mb-3">Informations de sante</h2>
                            </div>
                            <div>
                                <label for="poids">Poids en kg</label>
                                <input type="number" name="poids" id="poids" class="form-control" min="0" max="300" placeholder="Poids en kg" step="0.1" required>
                            </div>
                            <div>
                                <label for="taille">Taille en cm</label>
                                <input type="number" name="taille" id="taille" class="form-control" min="0" max="250" placeholder="Taille en cm" step="0.1" required>
                            </div>
                            <div class="col-12 d-flex justify-content-between flex-wrap gap-2">
                                <button type="button" id="btnRetour" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Retour</button>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-2"></i>Creer mon compte</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<script>
    const stepOne = document.getElementById('etape1');
    const stepTwo = document.getElementById('etape2');
    const continueButton = document.getElementById('btnContinuer');
    const backButton = document.getElementById('btnRetour');

    continueButton.addEventListener('click', function () {
        const nom = document.getElementById('nom').value.trim();
        const email = document.getElementById('email').value.trim();
        const motDePasse = document.getElementById('mot_de_passe').value.trim();
        const genre = document.querySelector('input[name="genre"]:checked');

        if (nom && email && motDePasse && genre) {
            stepOne.classList.add('d-none');
            stepTwo.classList.remove('d-none');
        } else {
            alert('Veuillez remplir tous les champs');
        }
    });

    backButton.addEventListener('click', function () {
        stepTwo.classList.add('d-none');
        stepOne.classList.remove('d-none');
    });
</script>

<?= view('header/footer') ?>