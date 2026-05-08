<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiviteSportiveModel extends Model
{
    protected $table = 'activite_sportive';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nom',
        'variation_poids',
        'duree',
    ];

    protected $validationRules = [
        'nom' => 'required|min_length[3]',
        'variation_poids' => 'required|decimal[10,2]',
        'duree' => 'required|integer|greater_than[0]',
    ];

    public function getAllActivites(): array
    {
        return $this->findAll();
    }

    public function getActiviteById(int $id): ?array
    {
        return $this->find($id);
    }

    public function createActivite(array $data): bool
    {
        return $this->insert($data) !== false;
    }

    public function updateActivite(int $id, array $data): bool
    {
        return $this->update($id, $data) !== false;
    }

    public function deleteActivite(int $id): bool
    {
        return $this->delete($id) !== false;
    }
}