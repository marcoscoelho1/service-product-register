<?php

namespace App\Modules\Products\UseCases;

use App\Modules\Products\Domain\Repositories\IProductsRepository;

class ListProductsUseCase
{
    private $productsRepository;

    public function __construct(IProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function execute()
    {

        return $this->productsRepository->find();
    }
}
