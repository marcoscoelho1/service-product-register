<?php

namespace App\Modules\Products\Infra\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Modules\Products\UseCases\ListProductsUseCase;
use App\Modules\Products\UseCases\SaveProductsUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Modules\Products\Infra\Requests\CreateProductRequest;
use Illuminate\Support\Facades\Redis;

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
        $cacheKey = ProductsController::PRODUCTS_CACHE_KEY . ':' . $page . ':' . $perPage;
        $products = Cache::store('redis')->get($cacheKey);

        if (!$products) {
            $products = $this->listProductsUseCase->execute($perPage);
            Cache::store('redis')->put($cacheKey, $products, now()->addHour());
        }

        return ApiResponse::success($products);
    }

    public function store(CreateProductRequest $request)
    {
        $request->validated();

        try {
            $product = [];
            $product['name'] = $request->input('name');
            $product['price'] = $request->input('price');
            $product['situation'] = $request->input('situation');
            $product['image'] = $request->input('image') ?? '';
            $product['category_id'] = $request->input('category_id');

            $products = $this->saveProductsUseCase->execute($product);

            $this->flushProductsCache();

            return ApiResponse::success($products);
        } catch (\Exception $error) {
            return ApiResponse::error($error->getMessage());
        }
    }

    private function flushProductsCache()
    {
        $keys = Redis::keys('*:' . self::PRODUCTS_CACHE_KEY . ':*');
        foreach ($keys as $key) {
            Redis::del($key);
        }
    }
}
