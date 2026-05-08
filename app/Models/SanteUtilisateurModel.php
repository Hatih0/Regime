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

    public function getAllSanteInfoUser(int $id_utilisateur): ?array
    {
        return $this->where('id_utilisateur', $id_utilisateur)
        ->orderBy('date_mesure', 'DESC')
        ->findAll();
    }

    //Farany recent ndrindra
    public function getCurrentSanteInfoUser(int $id_utilisateur): ?array
    {
        return $this->where('id_utilisateur', $id_utilisateur)->orderBy('date_mesure', 'DESC')->first();
    }

    public function calculIMC(int $id_utilisateur): ?float
    {
        $data = $this->where('id_utilisateur', $id_utilisateur)->orderBy('date_mesure', 'DESC')->first();
        $poids = $data['poids'];
        $taille = $data['taille'] / 100;
        return (float) ( $poids / ($taille * $taille) ) ;
    }
}
