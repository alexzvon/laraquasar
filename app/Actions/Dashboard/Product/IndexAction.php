<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Category;
use App\Models\Product;
use App\Http\Resources\Dashboard\Product\IndexCategoryResource;
use App\Http\Resources\Dashboard\Product\IndexProductResource;

class IndexAction
{
    public function __invoke(int $category_id, int $product_id): array
    {
        return [ 
            'categories' => fn() => Category::getAll(), 
            'category' => fn() => IndexCategoryResource::make($this->category($category_id))->resolve(),
            'product' => fn() => $product_id > 0 ? IndexProductResource::make(Product::find($product_id))->resolve() : null,
        ];
    }

    protected function category($id): Category
    {
        return $id > 0 ? Category::with('products')->find($id) : Category::with('products')->find(1);
        // return 
        //     $id > 0 ? 
        //     Category::with('products')->find($id)->makeHidden(['created_at', 'updated_at']) : 
        //     Category::with('products')->find(1)->makeHidden(['created_at', 'updated_at']);
    }
}

