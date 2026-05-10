<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    private RegimeModel $regimeModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
    }

    public function index(): string
    {
        return view('dashboard/index');
    }

    public function activeUsersStats(): ResponseInterface
    {
        $db = db_connect();
        $startDate = new \DateTimeImmutable('-6 days');
        $endDate = new \DateTimeImmutable('today');

        $rows = $db->query(
            "SELECT DATE(date_mesure) AS stat_date, COUNT(DISTINCT id_utilisateur) AS total
             FROM sante_utilisateur
             WHERE date_mesure >= ?
             GROUP BY DATE(date_mesure)
             ORDER BY stat_date ASC",
            [$startDate->format('Y-m-d 00:00:00')]
        )->getResultArray();

        $indexed = [];
        foreach ($rows as $row) {
            $indexed[$row['stat_date']] = (int) $row['total'];
        }

        $labels = [];
        $values = [];
        for ($day = $startDate; $day <= $endDate; $day = $day->modify('+1 day')) {
            $key = $day->format('Y-m-d');
            $labels[] = $day->format('d/m');
            $values[] = $indexed[$key] ?? 0;
        }

        return $this->response->setJSON([
            'labels' => $labels,
            'values' => $values,
            'title' => 'Utilisateurs actifs par jour',
        ]);
    }

    public function popularRegimesStats(): ResponseInterface
    {
        $db = db_connect();
        $rows = $db->query(
            "SELECT r.nom AS label, COUNT(ar.id_regime) AS total
             FROM achat_regime ar
             INNER JOIN regime r ON r.id = ar.id_regime
             GROUP BY ar.id_regime, r.nom
             ORDER BY total DESC, r.nom ASC
             LIMIT 5"
        )->getResultArray();

        $labels = [];
        $values = [];
        foreach ($rows as $row) {
            $labels[] = $row['label'];
            $values[] = (int) $row['total'];
        }

        return $this->response->setJSON([
            'labels' => $labels,
            'values' => $values,
            'title' => 'Régimes les plus populaires',
        ]);
    }

    public function summaryStats(): ResponseInterface
    {
        $db = db_connect();
        $totalUsers = (int) $db->table('utilisateur')->countAllResults();
        $totalRegimes = (int) $this->regimeModel->countAllResults();
        $totalPurchases = (int) $db->table('achat_regime')->countAllResults();
        $activeUsers = (int) $db->query(
            "SELECT COUNT(DISTINCT id_utilisateur) AS total
             FROM sante_utilisateur
             WHERE date_mesure >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)"
        )->getRowArray()['total'];

        return $this->response->setJSON([
            'users' => $totalUsers,
            'regimes' => $totalRegimes,
            'purchases' => $totalPurchases,
            'activeUsers' => $activeUsers,
        ]);
    }

}