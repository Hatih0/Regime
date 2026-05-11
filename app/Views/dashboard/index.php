<?= view('header/header', [
    'pageTitle' => 'Dashboard',
    'pageSubtitle' => 'Tableau de bord de supervision',
]) ?>

<section class="hero-section">
    <div class="container-fluid position-relative py-4 py-lg-5">
        <div class="container-lg">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="hero-badge mb-3"><i class="bi bi-speedometer2"></i> Tableau de bord</span>
                    <h1 class="hero-title fw-bold mb-3">Vue d'ensemble du projet et indicateurs alimentés par la base de données.</h1>
                    <p class="hero-copy mb-4">Les graphiques ci-dessous se chargent en AJAX pour suivre l'activité des utilisateurs et la popularité des régimes en temps réel.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?= site_url('/adminAuth') ?>" class="btn btn-primary btn-lg"><i class="bi bi-shield-check me-2"></i>Accès admin</a>
                        <a href="<?= site_url('/login') ?>" class="btn btn-outline-dark btn-lg"><i class="bi bi-person-circle me-2"></i>Espace utilisateur</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-panel">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="icon-box"><i class="bi bi-graph-up-arrow"></i></div>
                            <div>
                                <div class="fw-semibold">Pilotage visuel</div>
                                <div class="small-muted">Synthèse des utilisateurs, régimes et achats.</div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="metric-box h-100">
                                    <div class="metric-label">Utilisateurs</div>
                                    <div class="metric-value" id="summaryUsers">-</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="metric-box h-100">
                                    <div class="metric-label">Régimes</div>
                                    <div class="metric-value" id="summaryRegimes">-</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="metric-box h-100">
                                    <div class="metric-label">Achats</div>
                                    <div class="metric-value" id="summaryPurchases">-</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="metric-box h-100">
                                    <div class="metric-label">Actifs 7j</div>
                                    <div class="metric-value" id="summaryActiveUsers">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="page-shell dashboard-shell">
    <div class="container-fluid">
        <div class="container-lg">
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="icon-box mb-3"><i class="bi bi-people"></i></div>
                        <h2 class="h5 fw-bold mb-2">Utilisateurs actifs</h2>
                        <p class="small-muted mb-0">Distincts par jour sur les 7 derniers jours.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="icon-box mb-3"><i class="bi bi-clipboard2-pulse"></i></div>
                        <h2 class="h5 fw-bold mb-2">Régimes populaires</h2>
                        <p class="small-muted mb-0">Classement des régimes les plus achetés.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="icon-box mb-3"><i class="bi bi-bar-chart-line"></i></div>
                        <h2 class="h5 fw-bold mb-2">Données live</h2>
                        <p class="small-muted mb-0">Graphes mis à jour depuis l'API AJAX.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="icon-box mb-3"><i class="bi bi-lightning-charge"></i></div>
                        <h2 class="h5 fw-bold mb-2">Lecture rapide</h2>
                        <p class="small-muted mb-0">Vue de pilotage simple et exploitable.</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-xl-7">
                    <div class="glass-card chart-card h-100">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                            <div>
                                <h2 class="h4 fw-bold mb-1">Utilisateurs actifs par jour</h2>
                                <p class="small-muted mb-0">Mesures quotidiennes distinctes sur les 7 derniers jours.</p>
                            </div>
                            <span class="badge badge-soft-primary">AJAX</span>
                        </div>
                        <div class="chart-wrap">
                            <canvas id="activeUsersChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="glass-card chart-card h-100">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                            <div>
                                <h2 class="h4 fw-bold mb-1">Régimes les plus populaires</h2>
                                <p class="small-muted mb-0">Basé sur les achats enregistrés en base.</p>
                            </div>
                            <span class="badge badge-soft-warning">Chart.js</span>
                        </div>
                        <div class="chart-wrap chart-wrap-sm">
                            <canvas id="popularRegimesChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const endpoints = {
            summary: '<?= site_url('/dashboard/stats/summary') ?>',
            activeUsers: '<?= site_url('/dashboard/stats/active-users') ?>',
            popularRegimes: '<?= site_url('/dashboard/stats/popular-regimes') ?>',
        };

        const summaryMap = {
            users: document.getElementById('summaryUsers'),
            regimes: document.getElementById('summaryRegimes'),
            purchases: document.getElementById('summaryPurchases'),
            activeUsers: document.getElementById('summaryActiveUsers'),
        };

        const activeCanvas = document.getElementById('activeUsersChart');
        const popularCanvas = document.getElementById('popularRegimesChart');

        const safeFetchJson = async (url) => {
            const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            return response.json();
        };

        try {
            const [summary, activeUsers, popularRegimes] = await Promise.all([
                safeFetchJson(endpoints.summary),
                safeFetchJson(endpoints.activeUsers),
                safeFetchJson(endpoints.popularRegimes),
            ]);

            summaryMap.users.textContent = summary.users ?? 0;
            summaryMap.regimes.textContent = summary.regimes ?? 0;
            summaryMap.purchases.textContent = summary.purchases ?? 0;
            summaryMap.activeUsers.textContent = summary.activeUsers ?? 0;

            if (activeCanvas) {
                new Chart(activeCanvas, {
                    type: 'line',
                    data: {
                        labels: activeUsers.labels ?? [],
                        datasets: [{
                            label: 'Utilisateurs actifs',
                            data: activeUsers.values ?? [],
                            borderColor: '#0f766e',
                            backgroundColor: 'rgba(15, 118, 110, 0.18)',
                            tension: 0.35,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#102033',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                            },
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { color: '#5c6b80' },
                            },
                            y: {
                                beginAtZero: true,
                                ticks: { color: '#5c6b80', precision: 0 },
                                grid: { color: 'rgba(16, 32, 51, 0.08)' },
                            },
                        },
                    },
                });
            }

            if (popularCanvas) {
                new Chart(popularCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: popularRegimes.labels ?? [],
                        datasets: [{
                            data: popularRegimes.values ?? [],
                            backgroundColor: [
                                '#0f766e',
                                '#14b8a6',
                                '#0ea5e9',
                                '#f59e0b',
                                '#8b5cf6',
                            ],
                            borderWidth: 0,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '68%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { color: '#102033', usePointStyle: true, boxWidth: 10 },
                            },
                            tooltip: {
                                backgroundColor: '#102033',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                            },
                        },
                    },
                });
            }
        } catch (error) {
            console.error('Dashboard stats load failed:', error);
            Object.values(summaryMap).forEach((node) => {
                if (node) {
                    node.textContent = '0';
                }
            });
        }
    });
</script>

<?= view('header/footer') ?>