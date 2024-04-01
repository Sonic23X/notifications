<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\CategoryResource;
use App\Interfaces\V1\CategoryInterface;
use App\Models\V1\Category;

class CategoryRepository implements CategoryInterface
{
    public function all(): CategoryResource
    {
        return CategoryResource::make(Category::all());
    }
}
