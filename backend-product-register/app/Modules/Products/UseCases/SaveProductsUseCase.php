<?php

namespace App\Modules\Products\UseCases;

use App\Modules\Category\Infra\Repositories\CategoryRepository;
use App\Modules\Products\Domain\Entities\Product;
use App\Modules\Products\Domain\Repositories\IProductsRepository;
use App\Exceptions\AppException;

class SaveProductsUseCase
{
    private $productsRepository;
    private $categoryRepository;

    public function __construct(IProductsRepository $productsRepository, CategoryRepository $categoryRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function execute($product)
    {
        $categoryExists = $this->categoryRepository->findById($product['category_id']);

        if (is_null($categoryExists)) {
            throw new AppException('Category doesn\'t exists.');
        }

        $product = new Product($product);

        return $this->productsRepository->save($product);
    }
}
