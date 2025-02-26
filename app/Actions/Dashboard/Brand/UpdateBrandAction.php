<?php

namespace App\Actions\Dashboard\Brand;

use Illuminate\Support\Facades\Storage;

class UpdateBrandAction
{
    public function __invoke($data, $model): int
    {
        $pathRoot = config('filesystems.disks.public.url');

        $model->title = $data->title;
        $model->slug = $data->slug;
        $model->href = $data->href;
        $model->sort = $data->sort;
        $model->description = $data->description ?? '';

        // dd($data->picture_image);

        if (! is_null($data->picture_image)) {
            if (is_dir($pathRoot.'/images/brand/'.$data->id)) {
                Storage::disk('public')->deleteDirectory('/images/brand/'.$data->id);
            }

            $pathImage = Storage::disk('public')->putFileAs(
                '/images/brand/'.$data->id,
                $data->picture_image,
                'brand.'.$data->picture_image->extension()
            );

            $model->picture_image = $pathRoot.'/'.$pathImage;
        }

        return $model->save();
    }
}
