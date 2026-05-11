<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeRechargementModel extends Model
{
    protected $table = 'code_rechargement';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['code', 'montant', 'status'];

    public function findByCode(string $code): ?array
    {
        return $this->where('code', $code)->first();
    }

    public function markUsed(int $id): bool
    {
        return (bool) $this->update($id, ['status' => 'utilise']);
    }

    public function generateCodes(int $count, float $amount): array
    {
        $codes = [];
        for ($i = 0; $i < $count; $i++) {
            $code = strtoupper(bin2hex(random_bytes(4)));
            // ensure uniqueness
            while ($this->where('code', $code)->first()) {
                $code = strtoupper(bin2hex(random_bytes(4)));
            }
            $this->insert(['code' => $code, 'montant' => $amount, 'status' => 'valide']);
            $codes[] = ['code' => $code, 'montant' => $amount];
        }
        return $codes;
    }
}
