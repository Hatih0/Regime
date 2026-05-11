<?php 

namespace App\Models;

use CodeIgniter\Model;

class ObjectifUtilisateurModel extends Model
{
    protected $table = 'utilisateur_objectif';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_utilisateur',
        'id_objectif',
        'poids',
        'date_choix'
    ];
    
    protected $validationRules = [
        'id_utilisateur' => 'required',
        'id_objectif' => 'required|in_list[1,2,3]',
        'poids'    => 'required|numeric'
    ];

    public function createObjectifUser(int $id_utilisateur, int $id_objectif, float $poids): int
    {
        //choix 1 mitombo : poids positif
        //choix 2 mihena : poids negatif
        //choix 3 manenjika IMC : poids positif fa checkena le option raha 3 rehefa calculena
        $data = [
            'id_utilisateur' => $id_utilisateur,
            'id_objectif' => $id_objectif,
            'poids' => $poids,
            'date_choix' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }
    
    public function getAllObjectifUser(int $id_utilisateur): ?array
    {
        return $this->where('id_utilisateur', $id_utilisateur)->orderBy('date_choix', 'DESC')->findAll();
    }

    public function getCurrentObjectifUser(int $id_utilisateur): ?array
    {
        return $this->where('id_utilisateur', $id_utilisateur)->orderBy('date_choix', 'DESC')->first();
    }

    public function getPoidsObjectif(int $id_utilisateur)
    {
        $objectif = $this->getCurrentObjectifUser($id_utilisateur);
        $choix = $objectif['id_objectif'] ?? 0;
        // $poids = floatval($objectif['poids'] ?? 0);$objectifLabels = [1 => 'Prise de masse musculaire', 2 => 'Perte de poids', 3 => 'Atteindre mon IMC idéal'];       
        if ($choix == 1) {
            return floatval($objectif['poids'] ?? 0);
        } elseif ($choix == 2) {
            return -floatval($objectif['poids'] ?? 0);
        } elseif ($choix == 3) {
            $imc = floatval($objectif['poids'] ?? 0); 

            $santeUserModel = new SanteUtilisateurModel();
            $santeactuelle = $santeUserModel->getCurrentSanteInfoUser($id_utilisateur);
            $poids_actuelle = floatval($santeactuelle['poids'] ?? 0);
            $taille_actuelle = floatval($santeactuelle['taille'] ?? 0);

            $poids_total_cible = $imc * ($taille_actuelle * $taille_actuelle); 
            return $poids_total_cible - $poids_actuelle;
        }
    }
    
}