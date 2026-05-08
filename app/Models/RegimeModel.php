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

}