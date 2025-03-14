<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DestroyImageAction
{
    public function __invoke(int $category_id, int $product_id, int $index_picture_image): array
    {
        $model = Product::find($product_id);

        if (array_key_exists($index_picture_image, $model->picture_image)) {
            $index = indexDirPictureImage($model->picture_image[$index_picture_image]);

            $arr = $model->picture_image;
            unset($arr[$index_picture_image]);
            $model->picture_image = reInstanceArray($arr);

            $model->save();
        }

        if (is_dir(config('filesystems.disks.public.root') . '/images/products/'. $product_id . '/' . $index)) {
            Storage::disk('public')->deleteDirectory('/images/products/'. $product_id . '/' . $index);
        }

        return ['category_id' => $category_id, 'product_id' => $product_id];
    }
}
