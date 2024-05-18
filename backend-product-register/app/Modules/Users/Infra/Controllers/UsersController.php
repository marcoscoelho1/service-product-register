<?php

namespace App\Modules\Users\Infra\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Modules\Users\UseCases\SaveUserUseCase;
use App\Modules\Users\UseCases\ListUsersUseCase;
use Illuminate\Http\Request;
use App\Modules\Users\Infra\Requests\CreateUsersRequest;

class UsersController extends Controller
{
    private $saveUsersUseCase;
    private $listUsersUseCase;

    public function __construct(SaveUserUseCase $saveUsersUseCase, ListUsersUseCase $listUsersUseCase)
    {
        $this->saveUsersUseCase = $saveUsersUseCase;
        $this->listUsersUseCase = $listUsersUseCase;
    }

    public function index()
    {

        $users = $this->listUsersUseCase->execute();
        return ApiResponse::success($users);
    }

    public function store(CreateUsersRequest $request)
    {
        $request->validated();

        try {

            $user = [];
            $user['name'] = $request->input('name');
            $user['email'] = $request->input('email');
            $hashedPassword = app('hash')->make($request->input('password'));
            $user['password'] = $hashedPassword;
            $user = $this->saveUsersUseCase->execute($user);

            return ApiResponse::success($user);
        } catch (\Exception $error) {
            return ApiResponse::error($error->getMessage());
        }
    }
}
