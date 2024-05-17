<?php

namespace App\Modules\Category\Infra\Repositories;

use App\Modules\Category\Domain\Entities\Category as CategoryEntity;
use App\Modules\Category\Domain\Repositories\ICategoryRepository;
use App\Modules\Category\Infra\Models\Category as CategoryModel;

class CategoryRepository implements ICategoryRepository
{
    public function save(CategoryEntity $category)
    {
        return CategoryModel::create([
            'name' => $category->getName(),
            'situation' => $category->getSituation()
        ]);
    }

    public function find()
    {
        return CategoryModel::all();
    }

    public function findById($id)
    {
        return CategoryModel::find($id);
    }
}
