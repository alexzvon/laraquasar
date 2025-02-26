<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class UpdateCategoryAction
{
    public function __invoke($model, $data): int
    {
        $pathRoot = config('filesystems.disks.public.url');

        $model->title = $data->title;
        $model->slug = $data->slug;
        $model->sort = $data->sort;

        if (! is_null($data->picture_image)) {
            if (is_dir($pathRoot.'/images/category/'.$data->id)) {
                Storage::disk('public')->deleteDirectory('images/category/'.$data->id);
            }

            $pathImage = Storage::disk('public')->putFileAs(
                'images/category/'.$data->id,
                $data->picture_image,
                'category.'.$data->picture_image->extension(),
            );

            $model->picture_image = $pathRoot.'/'.$pathImage;
        } else {
            $model->picture_image = $model->picture_image ?? '';
        }

        if (! is_null($data->picture_icon)) {
            if (is_dir($pathRoot.'/icons/category/'.$data->id)) {
                Storage::disk('public')->deleteDirectory('icon/category/'.$data->id);
            }

            $pathIcon = Storage::disk('public')->putFileAs(
                'icons/category/'.$data->id,
                $data->picture_icon,
                'category.'.$data->picture_icon->extension(),
            );

            $model->picture_icon = $pathRoot.'/'.$pathIcon;
        } else {
            $model->picture_icon = $model->picture_icon ?? '';
        }

        $model->save();

        Category::clearCache();

        return $model->id;
    }
}
