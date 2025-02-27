<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
// use App\Models\Characteristic;

class IndexCategoryAction
{
    public function __invoke($model): array
    {
        return [
            'categories' => Category::getAll(),
            'category' => $model,
            'characteristics' =>
                $model->characteristics()
                    ->with('children')
                    ->get()
                    ->makeHidden(['created_at', 'updated_at'])
                    ->toTree()
                    ->toArray()
        ];
    }
}
