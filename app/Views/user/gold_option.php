<?= view('header/header', [
    'pageTitle' => 'Option Gold',
    'pageSubtitle' => 'Remise de 15% sur tous les regimes',
]) ?>

<section class="page-shell">
    <div class="container">
        <?php if (!isset($user) || !is_array($user)) { $user = []; } ?>
        <?php $solde = isset($solde) ? (float) $solde : 0.0; ?>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-card">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-5">
                            <span class="section-tag mb-3"><i class="bi bi-gem"></i> Offre premium</span>
                            <h1 class="section-title fw-bold mb-3">Passez en Gold pour economiser sur chaque regime.</h1>
                            <p class="lead-copy mb-4">Avec Gold, l'utilisateur beneficie d'une remise automatique de 15% et d'un parcours plus premium.</p>
                            <div class="soft-card">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-box"><i class="bi bi-check2-circle"></i></div>
                                    <div>
                                        <div class="fw-semibold">Remise immediate</div>
                                        <div class="small-muted">Appliquee sur tous les regimes.</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-box"><i class="bi bi-stars"></i></div>
                                    <div>
                                        <div class="fw-semibold">Acces premium</div>
                                        <div class="small-muted">Positionne le projet avec un statut valorisant.</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-box"><i class="bi bi-shield-check"></i></div>
                                    <div>
                                        <div class="fw-semibold">Paiement unique</div>
                                        <div class="small-muted">Option a acheter une seule fois.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="status-box danger mb-3"><i class="bi bi-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>

                            <?php if ($user && (bool) $user['gold']): ?>
                                <div class="status-box success mb-4"><i class="bi bi-gem me-2"></i>Vous avez deja l'option Gold active. Remise de 15% sur tous les regimes.</div>
                            <?php else: ?>
                                <div class="hero-panel">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <div class="small-muted text-uppercase fw-semibold">Prix unique</div>
                                            <div class="metric-value">99.99 €</div>
                                        </div>
                                        <span class="badge badge-soft-warning rounded-pill px-3 py-2">-15% automatique</span>
                                    </div>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-4">
                                            <div class="soft-card h-100">
                                                <div class="icon-box mb-3"><i class="bi bi-percent"></i></div>
                                                <div class="fw-semibold">Remise</div>
                                                <div class="small-muted">15% sur tous les regimes</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="soft-card h-100">
                                                <div class="icon-box mb-3"><i class="bi bi-clock-history"></i></div>
                                                <div class="fw-semibold">Paiement</div>
                                                <div class="small-muted">Une seule fois</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="soft-card h-100">
                                                <div class="icon-box mb-3"><i class="bi bi-wallet2"></i></div>
                                                <div class="fw-semibold">Solde</div>
                                                <div class="small-muted"><?= number_format($solde, 2) ?> € disponible</div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($solde >= 99.99): ?>
                                        <form method="post" action="/buy-gold" class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-gem me-2"></i>Acheter Gold</button>
                                        </form>
                                    <?php else: ?>
                                        <div class="status-box warning mb-3"><i class="bi bi-exclamation-circle me-2"></i>Solde insuffisant. Il vous manque <?= number_format(99.99 - $solde, 2) ?> €.</div>
                                        <div class="d-flex justify-content-end">
                                            <a href="/wallet" class="btn btn-outline-primary"><i class="bi bi-wallet2 me-2"></i>Recharger le portefeuille</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="/user-profile" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Retour au profil</a>
                        <span class="small-muted">Option premium unique a vie</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('header/footer') ?>
