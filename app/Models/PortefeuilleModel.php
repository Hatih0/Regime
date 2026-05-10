<?php

namespace App\Models;

use CodeIgniter\Model;

class PortefeuilleModel extends Model
{
    protected $table = 'portefeuille';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['id_utilisateur', 'solde'];

    public function getByUser(int $userId): ?array
    {
        return $this->where('id_utilisateur', $userId)->first();
    }

    public function createForUser(int $userId): int
    {
        $result = $this->insert(['id_utilisateur' => $userId, 'solde' => 0], true);
        return $result ? $this->getInsertID() : 0;
    }

    public function addFunds(int $userId, float $amount): ?array
    {
        $port = $this->getByUser($userId);
        if (! $port) {
            $id = $this->createForUser($userId);
            $port = $this->find($id);
        }

        $newSolde = (float) $port['solde'] + $amount;
        $this->update($port['id'], ['solde' => $newSolde]);
        return $this->find($port['id']);
    }
}
