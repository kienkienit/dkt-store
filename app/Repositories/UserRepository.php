<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    const PER_PAGE = 5;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function paginate($page, $perPage = self::PER_PAGE)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
    }
}
