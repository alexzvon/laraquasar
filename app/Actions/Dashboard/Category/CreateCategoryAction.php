<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CreateCategoryAction
{
    public function __invoke(Category $root, $data): array
    {
        $pathRoot = config('filesystems.disks.public.url');

        $create = [
            'title' => $data->title,
            'sort' => $data->sort,
        ];

        if (! is_null($data->slug)) {
            $create['slug'] = $data->slug;
        }

        $model = Category::create($create, $root);

        if (! is_null($data->picture_image)) {
            $pathImage = Storage::disk('public')->putFileAs(
                'images/category/'.$model->id,
                $data->picture_image,
                'category.'.$data->picture_image->extension(),
            );

            $picture_image = $pathRoot.'/'.$pathImage;
        } else {
            $picture_image = '';
        }

        if (! is_null($data->picture_icon)) {
            $pathIcon = Storage::disk('public')->putFileAs(
                'icons/category/'.$model->id,
                $data->picture_icon,
                'category.'.$data->picture_icon->extension(),
            );

            $picture_icon = $pathRoot.'/'.$pathIcon;
        } else {
            $picture_icon = '';
        }

        $model->picture_image = $picture_image;
        $model->picture_icon = $picture_icon;
        $model->save();

        Category::clearCache();

        return [ 'category' => $model->id ];
    }
}
