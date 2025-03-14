<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DestroyAction
{
    public function __invoke(int $category_id, int $product_id): array
    {
        Product::destroy([ $product_id ]);

        if (is_dir(config('filesystems.disks.public.root') . '/images/products/'. $product_id)) {
            Storage::disk('public')->deleteDirectory('/images/products/'. $product_id);
        }
        
        return [ 'category_id' => $category_id, 'product_id' => 0 ];
    }
}
