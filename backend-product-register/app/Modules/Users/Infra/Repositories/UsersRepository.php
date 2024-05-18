<?php

namespace App\Modules\Users\Infra\Repositories;

use App\Modules\Users\Domain\Entities\User as UserEntity;
use App\Modules\Users\Domain\Repositories\IUsersRepository;
use App\Modules\Users\Infra\Models\Users as UsersModel;

class UsersRepository implements IUsersRepository
{
    public function save(UserEntity $user)
    {
        return UsersModel::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),

        ]);
    }

    public function find()
    {
        return UsersModel::all();
    }

    public function findByEmail(string $email)
    {
        return UsersModel::where('email', $email)->get();
    }
}
