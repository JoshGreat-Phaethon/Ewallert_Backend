<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function findById(int $id);

    public function getAll();

    public function create(array $data);

    public function update(Model $model, array $data);

    public function softDelete(int $id): bool;

    public function findWithTrashed(int $id);

    public function restore(int $id): bool;
}
