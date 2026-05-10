<?php

namespace App\Models;

use CodeIgniter\Model;

class RechargementModel extends Model
{
    protected $table = 'rechargement';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['id_portefeuille', 'id_code', 'date_rechargement'];

    public function createRecord(int $portefeuilleId, int $codeId)
    {
        return $this->insert(['id_portefeuille' => $portefeuilleId, 'id_code' => $codeId]);
    }
}
