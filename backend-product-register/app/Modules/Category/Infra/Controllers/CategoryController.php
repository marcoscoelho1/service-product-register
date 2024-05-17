<?php

namespace App\Modules\Category\Infra\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Category\UseCases\ListCategoryUseCase;
use App\Modules\Category\UseCases\SaveCategoryUseCase;
use Illuminate\Http\Request;

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
        return response()->json($categories, 200);
    }

    public function store(Request $request)
    {
        try {

            $name = $request->input('name');
            $situation = $request->input('situation');
            $category = $this->saveCategoryUseCase->execute($name, $situation);

            return response()->json($category, 201);
        } catch (\Exception $error) {
            return response()->json($error, 400);
        }
    }
}
