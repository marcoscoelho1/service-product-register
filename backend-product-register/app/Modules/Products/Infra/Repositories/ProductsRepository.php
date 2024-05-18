<?php

namespace App\Modules\Products\Infra\Repositories;

use App\Modules\Products\Domain\Entities\Product as ProductEntity;
use App\Modules\Products\Domain\Repositories\IProductsRepository;
use App\Modules\Products\Infra\Models\Products as ProductsModel;

class ProductsRepository implements IProductsRepository
{
    public function save(ProductEntity $product)
    {
        return ProductsModel::create([
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'image' => $product->getImage(),
            'situation' => $product->getSituation(),
            'category_id' => $product->getCategoryId()
        ]);
    }

    public function find($perPage = 50)
    {
        return ProductsModel::with('category')->paginate($perPage);
    }
}
