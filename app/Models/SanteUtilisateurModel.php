<?php 

namespace App\Models;

use CodeIgniter\Model;

class SanteUtilisateurModel extends Model
{
    protected $table = 'sante_utilisateur';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_utilisateur',
        'poids',
        'taille',
        'date_mesure'
    ];
    
    protected $validationRules = [
        'id_utilisateur' => 'required',
        'poids'      => 'required|greater_than[0]',
        'taille'    => 'required|greater_than[0]',
    ];

    public function createSanteInfo(int $id_utilisateur, float $poids, float $taille): int
    {
        $data = [
            'id_utilisateur' => $id_utilisateur,
            'poids' => $poids,
            'taille' => $taille,
            'date_mesure' => date('Y-m-d H:i:s')
        ];
        return $this->insert($data);
    }

    //Farany recent ndrindra
    public function getSanteInfoByUserId(int $id_utilisateur): ?array
    {
        return $this->where('id_utilisateur', $id_utilisateur)
        ->orderBy('date_mesure', 'DESC')
        ->first();
    }

}
