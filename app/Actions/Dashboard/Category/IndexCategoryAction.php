<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;

class IndexCategoryAction
{
    public function __invoke(): array
    {
        return Category::with('children')->orderBy('sort')->orderBy('id')->get()->toTree()->toArray();
    }
}
