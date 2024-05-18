<?php

namespace App\Modules\Users\UseCases;


use App\Modules\Users\Domain\Entities\User;
use App\Exceptions\AppException;
use App\Modules\Users\Domain\Repositories\IUsersRepository;

class SaveUserUseCase
{
    private $usersRepository;

    public function __construct(IUsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function execute($user)
    {
        $userExists = $this->usersRepository->findByEmail($user['email']);

        if (count($userExists) > 0) {
            throw new AppException('User already exists with this email.');
        }

        $newUser = new User($user);

        return $this->usersRepository->save($newUser);
    }
}
