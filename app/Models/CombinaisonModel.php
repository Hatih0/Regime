<?php
namespace App\Models;

class CombinaisonModel
{
    protected $regimeModel;
    protected $activiteModel;

    public function __construct()
    {
        $this->regimeModel   = new RegimeModel();
        $this->activiteModel = new ActiviteModel();
    }

    /**
     * Calcule le nb de jours pour atteindre $variation_objectif (signée).
     *
     * Unités :
     *   régime   → get_poids_gain_journalier()      = variation_poids / duree_jour  [kg/j]
     *   activité → get_variation_poids_journalier()  = variation_poids               [kg/j]
     *              (une séance par jour ; variation_poids EST déjà la contribution journalière)
     */
    public function get_efficacite_combinaison(
        array $regimes,
        array $activites,
        float $variation_objectif
    ): int {
        $gain_regime   = 0.0;
        $gain_activite = 0.0;

        foreach ($regimes as $regime) {
            $id = intval($regime['id'] ?? $regime['id_regime'] ?? 0);
            if ($id <= 0) continue;
            $gain_regime += $this->regimeModel->get_poids_gain_journalier($id);
        }

        foreach ($activites as $activite) {
            $id = is_array($activite)
                ? intval($activite['id'] ?? $activite['id_activite'] ?? 0)
                : intval($activite);
            if ($id <= 0) continue;
            // variation_poids = contribution journalière directe, pas de conversion nécessaire
            $gain_activite += $this->activiteModel->get_variation_poids_journalier($id);
        }

        $gain_journalier = $gain_regime + $gain_activite;

        if ($gain_journalier == 0.0)                              return PHP_INT_MAX;
        if ($variation_objectif > 0 && $gain_journalier <= 0)    return PHP_INT_MAX;
        if ($variation_objectif < 0 && $gain_journalier >= 0)    return PHP_INT_MAX;

        return (int) ceil(abs($variation_objectif) / abs($gain_journalier));
    }

    public function get_scores_combinaison(
        array $regimes,
        array $activites,
        float $variation_objectif,
        float $w1,
        float $w2,
        float $w3
    ): array {
        $nb_jours = $this->get_efficacite_combinaison($regimes, $activites, $variation_objectif);

        if ($nb_jours === PHP_INT_MAX) {
            return ['nb_jours' => PHP_INT_MAX, 'cout_total' => 0.0, 'score' => -INF];
        }

        $cout_total = $this->regimeModel->get_cout_totals_regimes($regimes, $nb_jours);

        // Intensité = abs(variation_poids / duree) [kg/h], calculée dans ActiviteModel
        $intensite = $this->activiteModel->get_intensites_somme($activites);

        $efficacite_score = 1.0 / ($nb_jours + 1);
        $cout_score       = 1.0 / (1.0 + $cout_total);
        // intensite déjà en kg/h, pas de borne supérieure fixe :
        // les 3 composantes sont comparables car w1+w2+w3 = 1 et intensite ~ ordre de grandeur 0-1 en pratique
        $intensite_score  = $intensite;

        $score = $w1 * $efficacite_score + $w2 * $cout_score + $w3 * $intensite_score;

        return [
            'nb_jours'   => $nb_jours,
            'cout_total' => $cout_total,
            'score'      => $score,
        ];
    }

    public function get_meilleure_combinaison(
        array $combinaisons,
        float $variation_objectif,
        float $w1,
        float $w2,
        float $w3
    ): array {
        if (empty($combinaisons)) {
            return ['combinaison' => null, 'nb_jours' => 0, 'prix_total' => 0.0];
        }

        // Passe 1 : calculer les métriques brutes pour toutes les combinaisons valides
        $valides = [];
        foreach ($combinaisons as $comb) {
            $regimes   = $comb['regimes']   ?? [];
            $activites = $comb['activites'] ?? [];

            $nb_jours_comb = $this->get_efficacite_combinaison($regimes, $activites, $variation_objectif);
            if ($nb_jours_comb === PHP_INT_MAX) continue;

            $cout = $this->regimeModel->get_cout_totals_regimes($regimes, $nb_jours_comb);
            $intensite = $this->activiteModel->get_intensites_somme($activites);

            $valides[] = [
                'comb'      => $comb,
                'nb_jours'  => $nb_jours_comb,
                'cout'      => $cout,
                'intensite' => $intensite,
            ];
        }

        if (empty($valides)) {
            return ['combinaison' => null, 'nb_jours' => 0, 'prix_total' => 0.0];
        }

        // Passe 2 : trouver les bornes pour normaliser chaque dimension sur [0, 1]
        $min_jours    = min(array_column($valides, 'nb_jours'));
        $max_jours    = max(array_column($valides, 'nb_jours'));
        $min_cout     = min(array_column($valides, 'cout'));
        $max_cout     = max(array_column($valides, 'cout'));
        $min_intensite = min(array_column($valides, 'intensite'));
        $max_intensite = max(array_column($valides, 'intensite'));

        // Passe 3 : scorer avec les valeurs normalisées
        $meilleure  = null;
        $nb_jours   = 0;
        $prix_total = 0.0;
        $best_score = -INF;

        foreach ($valides as $v) {
            // Normalisation min-max : 1 = meilleur, 0 = pire
            $eff_score = ($max_jours === $min_jours)
                ? 1.0
                : ($max_jours - $v['nb_jours']) / ($max_jours - $min_jours);   // moins de jours = mieux

            $cout_score = ($max_cout === $min_cout)
                ? 1.0
                : ($max_cout - $v['cout']) / ($max_cout - $min_cout);          // moins cher = mieux

            $int_score = ($max_intensite === $min_intensite)
                ? 1.0
                : ($v['intensite'] - $min_intensite) / ($max_intensite - $min_intensite); // plus intense = mieux

            $score = $w1 * $eff_score + $w2 * $cout_score + $w3 * $int_score;

            if ($score > $best_score) {
                $best_score = $score;
                $nb_jours   = $v['nb_jours'];
                $prix_total = $v['cout'];
                $meilleure  = $v['comb'];
            }
        }

        return [
            'combinaison' => $meilleure,
            'nb_jours'    => $nb_jours,
            'prix_total'  => $prix_total,
        ];
    }

    /**
     * Power-set de régimes × UNE SEULE activité.
     */
    public function get_combinaisons_filtres(array $allregimes, array $allactivites): array
    {
        $regComb = $this->regimeModel->get_combinaisons_regimes_recursives($allregimes);

        $combinaisons = [];
        foreach ($regComb as $r) {
            foreach ($allactivites as $a) {
                $combinaisons[] = ['regimes' => $r, 'activites' => [$a]];
            }
        }
        return $combinaisons;
    }
}