<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;

class StoreAction
{
    public function __invoke(array $data): array
    {
        $model = Product::create([ 
            'active' => $data[ 'active' ],
            'sort' => $data[ 'sort' ],
            'title' => $data[ 'title' ],
        ]);

        $model->categories()->attach($data['category_id']);

        return [ 'category_id' => $data['category_id'], 'product_id' => $model->id ];
    }
}
