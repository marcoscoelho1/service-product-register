<?php

namespace App\Modules\Category\UseCases;

use App\Modules\Category\Domain\Repositories\ICategoryRepository;



class ListCategoryUseCase
{
    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute()
    {

        return $this->categoryRepository->find();
    }
}
