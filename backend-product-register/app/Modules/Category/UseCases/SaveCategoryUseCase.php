<?php

namespace App\Modules\Category\UseCases;

use App\Modules\Category\Domain\Entities\Category;
use App\Modules\Category\Domain\Repositories\ICategoryRepository;



class SaveCategoryUseCase
{
    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute($name, $situation)
    {
        $category = new Category($name, $situation);

        return $this->categoryRepository->save($category);
    }
}
