<?php

namespace App\Modules\Products\Infra\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Modules\Products\UseCases\ListProductsUseCase;
use App\Modules\Products\UseCases\SaveProductsUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductsController extends Controller
{
    private $saveProductsUseCase;
    private $listProductsUseCase;
    const PRODUCTS_CACHE_KEY = 'products';

    public function __construct(SaveProductsUseCase $saveProductsUseCase, ListProductsUseCase $listProductsUseCase)
    {
        $this->saveProductsUseCase = $saveProductsUseCase;
        $this->listProductsUseCase = $listProductsUseCase;
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page') ?? null;
        $page = $request->get('page') ?? 1;
        $cacheKey = ProductsController::PRODUCTS_CACHE_KEY . '_' . $page . '_' . $perPage;
        $products = Cache::store('redis')->get($cacheKey);

        if (!$products) {
            $products = $this->listProductsUseCase->execute($perPage);
            Cache::store('redis')->put($cacheKey, $products, now()->addHour());
        }

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

            $products = $this->saveProductsUseCase->execute($product);

            return ApiResponse::success($products);
        } catch (\Exception $error) {
            return ApiResponse::error($error->getMessage());
        }
    }
}
