<?php

namespace App\Modules\Products\Infra\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Modules\Products\UseCases\ListProductsUseCase;
//use App\Modules\Products\UseCases\ListCategoryUseCase;
use App\Modules\Products\UseCases\SaveProductsUseCase;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $saveProductsUseCase;
    private $listProductsUseCase;

    public function __construct(SaveProductsUseCase $saveProductsUseCase, ListProductsUseCase $listProductsUseCase)
    {
        $this->saveProductsUseCase = $saveProductsUseCase;
        $this->listProductsUseCase = $listProductsUseCase;
    }

    public function index()
    {
        $products = $this->listProductsUseCase->execute();
        return ApiResponse::success($products);
    }

    public function store(Request $request)
    {
        try {

            $product = [];

            $product['name'] = $request->input('name');
            $product['price'] = $request->input('price');
            $product['situation'] = $request->input('situation');
            $product['image'] = $request->input('image') ?? '';
            $product['category_id'] = $request->input('category_id');

            $category = $this->saveProductsUseCase->execute($product);

            return ApiResponse::success($category);
        } catch (\Exception $error) {
            return ApiResponse::error($error->getMessage());
        }
    }
}
