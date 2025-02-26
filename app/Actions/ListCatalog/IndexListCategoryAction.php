<?php

namespace App\Actions\ListCatalog;

use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;

class IndexListCategoryAction
{
    public function __invoke(string $slug): array
    {
        $category = Category::query()->where('slug', $slug)->first();

        return [
            'list_categories' => CategoryCollection::make(Category::query()->where('parent_id', $category->id)->get()),
            'breadcrumbs' => CategoryCollection::make($category->ancestors->sortBy('id')),
        ];
    }
}
