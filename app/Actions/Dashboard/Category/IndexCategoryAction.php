<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use App\Models\Characteristic;

class IndexCategoryAction
{
    public function __invoke($model): array
    {


        // dd($model);

        return [
            'categories' => Category::getAll(),
            // 'selected' => $model,
            'category' => $model,
            'characteristics' =>
                Characteristic::with('children')
                    ->where('category_id', $model->id)
                    ->get()
                    ->makeHidden(['created_at', 'updated_at'])
                    ->toTree()
                    ->toArray(),
        ];
    }
}
