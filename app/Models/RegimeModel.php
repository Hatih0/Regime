<?php 

namespace App\Models;
use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'regime';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nom',
        'pourcentage_viande',
        'pourcentage_poisson',
        'pourcentage_volaille',
        'variation_poids',
        'duree_jour',
        'prix'
    ];

    protected $validationRules = [
        'nom' => 'required|min_length[3]',
        'pourcentage_poisson' => 'required|decimal[10,2]|greater_than_equal_to[0]|less_than_equal_to[100]',
        'pourcentage_volaille' => 'required|decimal[10,2]|greater_than_equal_to[0]|less_than_equal_to[100]',
        'variation_poids' => 'required|decimal[10,2]',
        'duree_jour' => 'required|integer|greater_than[0]',
        'prix' => 'required|decimal[10,2]|greater_than_equal_to[0]'
    ];

    public function getAllRegimes(): array
    {
        return $this->findAll();
    }

    public function getRegimeById(int $id): ?array
    {
        return $this->find($id);
    }

    public function createRegime(array $data): bool
    {
        return $this->insert($data) !== false;
    }

    public function updateRegime(int $id, array $data): bool
    {
        return $this->update($id, $data) !== false;
    }

    public function deleteRegime(int $id): bool
    {
        return $this->delete($id) !== false;
    }

    // (variation_poids / jour) Un repas de ce regime par jour
    public function get_poids_gain_journalier(int $id): float
    {
        $regime = $this->getRegimeById($id);
        if (!$regime) {
            return 0.0;
        }
        $variation = floatval($regime['variation_poids'] ?? 0);
        $duree = intval($regime['duree_jour'] ?? ($regime['duree_jour'] ?? 1));
        if ($duree <= 0) {
            $duree = 1;
        }
        return $variation / $duree;
    }

    //total regime pour nb_jours 
    public function get_cout_totals_regimes(array $regimes, int $nb_jours): float
    {
        $prix_total = 0.0;
        foreach ($regimes as $regime) {
            $id = intval($regime['id'] ?? $regime['id_regime'] ?? 0);
            if ($id <= 0) continue;
            $r = $this->getRegimeById($id);
            if (!$r) continue;
            $prix = floatval($r['prix'] ?? 0);
            $duree = intval($r['duree_jour'] ?? 1);
            if ($duree <= 0) $duree = 1;

            $prix_total += ($prix / $duree) * $nb_jours;
        }
        return $prix_total;
    }

    //combinaison regime , taille variable
    public function get_combinaisons_regimes_recursives(array $regimes, int $index = 0)
    {
        if ($index >= count($regimes)) {
            return [[]];
        }
        $combinaisons = [];
        $sous = $this->get_combinaisons_regimes_recursives($regimes, $index + 1);
        foreach ($sous as $s) {
            $new = array_merge([$regimes[$index]], $s);
            $combinaisons[] = $new;
            if (count($s) > 0) {
                $combinaisons[] = $s;
            }
        }
        return $combinaisons;
    }

}
