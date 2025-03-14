<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class StoreImageAction
{
    public function __invoke(array $data): array
    {
        // dump($data);
        // dump($data->all());

        // dd('code');

        $data['picture_image'] ??= [];

        $pathRoot = config('filesystems.disks.public.url');

        $maxIndexDir = maxIndexDir(Storage::disk('public')->directories('images/products' . '/' . $data['id'])) + 1;

        if (! is_null($data['image'])) {
            $pathImage = Storage::disk('public')->putFileAs(
                'images/products/' . $data['id'] . '/' . $maxIndexDir,
                $data['image'],
                'product.' . $data['image']->extension(),
            );

            $data['picture_image'][] = $pathRoot . '/' . $pathImage;

            Product::where('id', $data['id'])->update(['picture_image' => $data['picture_image']]);
        }

        return [ 'category_id' => $data['category_id'], 'product_id' => $data['id']];
    }
}

