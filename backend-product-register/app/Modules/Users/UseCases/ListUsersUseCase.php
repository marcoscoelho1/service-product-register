<?php

namespace App\Modules\Users\UseCases;

use App\Modules\Users\Domain\Repositories\IUsersRepository;

class ListUsersUseCase
{
    private $usersRepository;

    public function __construct(IUsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function execute($perPage = null)
    {

        return $this->usersRepository->find($perPage);
    }
}
