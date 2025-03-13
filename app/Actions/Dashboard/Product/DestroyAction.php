<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;

class DestroyAction
{
    public function __invoke(int $category_id, int $product_id): array
    {
        Product::destroy([ $product_id ]);
        
        return [ 'category_id' => $category_id, 'product_id' => 0 ];
    }
}
