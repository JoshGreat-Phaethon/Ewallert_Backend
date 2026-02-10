<?php
namespace App\Repository;
use App\Models\Transaksi;
use App\Repository\Interface\BaseRepositoryInterface;

class TransaksiRepository
{
    public function create(array $data)
    {
        return Transaksi::create($data);
    }
}