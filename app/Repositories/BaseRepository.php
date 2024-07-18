<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->findById($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        return $model->delete();
    }

    public function paginate($page, $perPage)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
    }
}
