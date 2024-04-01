<?php

namespace App\Repositories;

use App\Http\Resources\V1\CategoryResource;
use App\Interfaces\V1\CategoryInterface;
use App\Models\V1\Category;

class CategoryRepository extends CategoryInterface
{
    public function all() {
        return CategoryResource::collection(Category::all());
    }
}
