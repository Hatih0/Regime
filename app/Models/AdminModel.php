<?php 

namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'nom',
        'password',

    ];

    protected $validationRules = [
        'password' => 'required|min_length[6]',
        'nom'      => 'required|min_length[2]'
    ];

    public function checkUser(string $nom, string $password): ?array
    {
        $user = $this->where('nom', $nom)->first();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null; 
    }

}