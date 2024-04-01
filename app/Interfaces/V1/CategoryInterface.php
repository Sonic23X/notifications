<?php

namespace App\Interfaces\V1;

use App\Http\Resources\V1\CategoryResource;

interface CategoryInterface
{
    public function all();

    public function findOne(string $uuid);
}
