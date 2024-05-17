<?php

namespace App\Modules\Category\Domain\Repositories;

use App\Modules\Category\Domain\Entities\Category;

interface ICategoryRepository
{
    public function save(Category $category);
    public function find();
    public function findById(int $id);
}
