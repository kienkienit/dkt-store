<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function paginate($page, $perPage)
    {
        return $this->user->paginate($perPage, ['*'], 'page', $page);
    }

    public function create(array $data) {
        return $this->user->create($data);
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function findById($id)
    {
        return $this->user->find($id);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}

