<?php 

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nom',
        'email',
        'mot_de_passe',
        'date_inscription',
        'genre',
        'gold'
    ];

    protected $validationRules = [
        'mot_de_passe' => 'required|min_length[6]',
        'nom'      => 'required|min_length[2]',
        'email'      => 'required|min_length[2]',
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

    public function createUser(string $nom, string $email,string $mot_de_passe, string $genre): int {
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $data = [
            'nom' => $nom,
            'email' => $email,
            'mot_de_passe' => $hashedPassword,
            'genre' => $genre,
            'date_inscription' => date('Y-m-d H:i:s'),
            'gold' => 0
        ];
        return $this->insert($data);
    }
    
    public function getInfoUser(int $id): ?array
    {   
        
        return $this->select(['nom', 'email', 'genre', 'date_inscription', 'gold'])
                ->where('id', $id)
                ->first();
                
    }

    public function updateUtilisateur(int $id, string $nom, string $email, string $genre): bool
    {
        $data = [
            'nom' => $nom,
            'email' => $email,
            'genre' => $genre
        ];
        return $this->update($id, $data);
    }

}