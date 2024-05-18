<?php

namespace App\Modules\Category\Infra\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Modules\Category\UseCases\ListCategoryUseCase;
use App\Modules\Category\UseCases\SaveCategoryUseCase;
use App\Modules\Category\Infra\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
    private $saveCategoryUseCase;
    private $listCategoryUseCase;

    public function __construct(SaveCategoryUsecase $saveCategoryUseCase, ListCategoryUseCase $listCategoryUseCase)
    {
        $this->saveCategoryUseCase = $saveCategoryUseCase;
        $this->listCategoryUseCase = $listCategoryUseCase;
    }

    public function index()
    {
        $categories = $this->listCategoryUseCase->execute();
        return ApiResponse::success($categories);
    }

    public function store(CreateCategoryRequest $request)
    {
        $request->validated();

        try {
            $name = $request->input('name');
            $situation = $request->input('situation');
            $category = $this->saveCategoryUseCase->execute($name, $situation);

            return ApiResponse::success($category, 201);
        } catch (\Exception $error) {
            return ApiResponse::error($error->getMessage());
        }
    }
}
