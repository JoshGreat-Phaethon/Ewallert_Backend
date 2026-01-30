<?php
namespace App\Repository;
use App\Models\Transaksi;

class TransaksiRepository
{
    public function create(array $data)
    {
        return Transaksi::create($data);
    }
}