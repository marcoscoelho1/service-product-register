<?php

namespace App\Modules\Users\Domain\Repositories;

use App\Modules\Users\Domain\Entities\User;

interface IUsersRepository
{
    public function save(User $user);
    public function findByEmail(string $email);
    public function find();
}
