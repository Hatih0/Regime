<?= view('header/header', [
    'pageTitle' => 'Choix de l objectif',
    'pageSubtitle' => 'Selection du but principal',
]) ?>

<section class="page-shell">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-card">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-5">
                            <span class="section-tag mb-3"><i class="bi bi-bullseye"></i> Objectif</span>
                            <h1 class="section-title fw-bold mb-3">Choisissez l'objectif qui guidera le regime suggere.</h1>
                            <p class="lead-copy mb-4">Le parcours adapte l'IMC, la variation de poids et les besoins sportifs selon votre selection.</p>
                            <div class="soft-card">
                                <div class="small-muted mb-2">Trois parcours possibles</div>
                                <div class="pill-list">
                                    <span class="pill">Prise de masse</span>
                                    <span class="pill">Perte de poids</span>
                                    <span class="pill">IMC ideal</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form action="/create-objectif" method="post" class="section-card">
                                <div>
                                    <label class="d-block mb-2">Sélectionnez votre objectif</label>
                                    <div class="d-grid gap-2">
                                        <div class="form-check p-3 border rounded-4 bg-white">
                                            <input type="radio" class="form-check-input" name="id_objectif" value="1" id="objectif_1">
                                            <label class="form-check-label ms-2" for="objectif_1">Prise de masse musculaire</label>
                                        </div>
                                        <div class="form-check p-3 border rounded-4 bg-white">
                                            <input type="radio" class="form-check-input" name="id_objectif" value="2" id="objectif_2" checked>
                                            <label class="form-check-label ms-2" for="objectif_2">Perte de poids</label>
                                        </div>
                                        <div class="form-check p-3 border rounded-4 bg-white">
                                            <input type="radio" class="form-check-input" name="id_objectif" value="3" id="objectif_3">
                                            <label class="form-check-label ms-2" for="objectif_3">Atteindre mon IMC idéal</label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="poids">Valeur cible</label>
                                    <div class="input-group">
                                        <input type="number" name="poids" id="poids" step="0.1" required value="10" class="form-control">
                                        <span class="input-group-text" id="unite">kg</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-2"></i>Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const radioPoids = document.getElementById('objectif_1');
    const radioImc = document.getElementById('objectif_3');
    const inputPoids = document.getElementById('poids');
    const spanUnite = document.getElementById('unite');

    function updateInputBasedOnObjective() {
        if (radioPoids.checked) {
            inputPoids.value = 10;
            spanUnite.textContent = 'kg';
        } else if (radioImc.checked) {
            inputPoids.value = 22.0;
            spanUnite.textContent = 'kg/m²';
        } else {
            inputPoids.value = 10;
            spanUnite.textContent = 'kg';
        }
    }

    document.querySelectorAll('input[name="id_objectif"]').forEach((radio) => {
        radio.addEventListener('change', updateInputBasedOnObjective);
    });

    updateInputBasedOnObjective();
</script>

<?= view('header/footer') ?>