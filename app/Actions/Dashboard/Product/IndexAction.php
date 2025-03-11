<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Category;
use App\Models\Product;


class IndexAction
{
    public function __invoke(int $category_id, int $product_id): array
    {
        return [ 
            'categories' => fn() => Category::getAll(), 
            'category' => fn() => $this->category($category_id),
            'product' => fn() => $this->product($product_id),
        ];


        // dd(Category::with('products')->find($category_id)->makeHidden(['created_at', 'updated_at']));


        // return match($category_id > 0){
        //     true => [ 
        //         'categories' => fn() => Category::getAll(),
        //         'category' => fn()  => Category::with('products')->find($category_id)->makeHidden(['created_at', 'updated_at']),
        //     ],
        //     default => [ 
        //         'categories' => fn() => Category::getAll(), 
        //         'category' => null,
        //         'product' => null,
        //     ],
        // };
    }

    protected function category($id): ?Category
    {
        return $id > 0 ? Category::with('products')->find($id)->makeHidden(['created_at', 'updated_at']) : null;
    }

    protected function product($id): ?Product
    {
        return $id > 0 ? Product::find($id)->makeHidden(['created_at', 'updated_at']) : null;
    }
}

