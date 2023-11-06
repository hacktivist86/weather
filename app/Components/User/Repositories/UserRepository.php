<?php

namespace App\Components\User\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(protected User $user)
    {
    }

    public function findOneBy(array $conditions): ?User
    {
        return $this->user->where($conditions)->first();
    }

    public function create(array $data = []): User
    {
        return $this->user->create($data);
    }
}
