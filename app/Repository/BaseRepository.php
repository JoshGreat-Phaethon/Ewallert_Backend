<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data)
    {
        $model->update($data);
        return $model;
    }

    public function softDelete(int $id): bool
    {
        return (bool) $this->model->where('id', $id)->delete();
    }

    public function findWithTrashed(int $id)
    {
        return $this->model->withTrashed()->find($id);
    }

    public function restore(int $id): bool
    {
        return (bool) $this->model
            ->withTrashed()
            ->where('id', $id)
            ->restore();
    }
}
