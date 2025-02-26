<?php

namespace App\Actions\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class StoreBrandAction
{
    public function __invoke($data): Brand
    {
        $pathRoot = config('filesystems.disks.public.url');

        $model = Brand::create([
            'title' => $data->title,
            'slug' => $data->slug,
            'href' => $data->href,
            'sort' => $data->sort,
            'description' => $data->description ?? '',
            'picture_image' => '',
        ]);

        if (! is_null($data->picture_image)) {
            $pathImage = Storage::disk('public')->putFileAs(
                'images/brand/'.$model->id,
                $data->picture_image,
                'brand.'.$data->picture_image->extension()
            );

            $model->picture_image = $pathRoot.'/'.$pathImage;
            $model->save();
        }

        return $model;
    }
}
