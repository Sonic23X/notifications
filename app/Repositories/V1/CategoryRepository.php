<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\CategoryResource;
use App\Interfaces\V1\CategoryInterface;
use App\Models\V1\Category;

class CategoryRepository implements CategoryInterface
{
    // To-DO: Revisar porque no se está retornando correctamente el CategoryResource
    // Posiblemente por cambio en la versión de Laravel
    public function all()
    {
        return CategoryResource::collection(Category::all())->resolve();
    }

    public function findOne(string $uuid)
    {
        return CategoryResource::make(Category::where('uuid', $uuid)->firstOrFail());
    }
}
