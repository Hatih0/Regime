<?php 

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'nom',
        'mot_de_passe',
        'date_inscription',
        'genre',
        'gold'
    ];

    protected $validationRules = [
        'mot_de_passe' => 'required|min_length[6]',
        'nom'      => 'required|min_length[2]',
        'genre'    => 'required|in_list[Homme,Femme,Autre]'
    ];

    public function checkUser(string $nom, string $mot_de_passe): ?array
    {
        $user = $this->where('nom', $nom)->first();
        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }
        return null; 
    }

}