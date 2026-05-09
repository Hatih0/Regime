<?php
namespace App\Models;

use CodeIgniter\Model;

class ActiviteModel extends Model
{
    protected $table = 'activite_sportive';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['nom', 'variation_poids', 'duree'];

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getById(int $id): ?array
    {
        return $this->find($id);
    }

    // 1 session de duree d / jour
    public function get_variation_poids_journalier(int $id): float
    {
        $a = $this->getById($id);
        if (!$a) return 0.0;
        return floatval($a['variation_poids'] ?? 0);
    }

    // variation_poids / duree d (hatao heure sa minute)
    public function get_intensite(array $activite): float
    {
        $variation = floatval($activite['variation_poids'] ?? 0);
        $duree = intval($activite['duree'] ?? 1);
        if ($duree <= 0) $duree = 1;
        return $variation / $duree;
    }

    //somme des intensites activites
    public function get_intensites_somme(array $activites): float
    {
        $somme = 0.0;
        foreach ($activites as $a) {
            if (is_array($a)) {
                $somme += $this->get_intensite($a);
            } else {
                $item = $this->getById(intval($a));
                if ($item) $somme += $this->get_intensite($item);
            }
        }
        return $somme;
    }

    //Combinaison activite : 3 max
    public function get_combinaisons_activites_recursives(array $activites, int $index = 0, int $maxSize = 3)
    {
        if ($index >= count($activites)) {
            return [[]];
        }
        $combinaisons = [];
        $sous = $this->get_combinaisons_activites_recursives($activites, $index + 1, $maxSize);
        foreach ($sous as $s) {
            // ajoute la combinaison qui contient l'element courant
            $new = array_merge([$activites[$index]], $s);
            if (count($new) <= $maxSize) {
                $combinaisons[] = $new;
            }
            // ajoute la sous-combinaison seule (si taille ok)
            if (count($s) <= $maxSize && count($s) > 0) {
                $combinaisons[] = $s;
            }
        }
        return $combinaisons;
    }
}
