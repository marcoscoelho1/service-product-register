<?php

namespace App\Modules\Products\Domain\Repositories;

use App\Modules\Products\Domain\Entities\Product;

interface IProductsRepository
{
    public function save(Product $product);
    public function find();
}
