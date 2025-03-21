<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AppendAction
{
    public function __invoke(Category $temp, $data): array
    {
        $pathRoot = config('filesystems.disks.public.url');

        $root = $temp->parent;

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

        return [ 'category_id' => $model->id, 'characteristic_id' => 0 ];
    }
}
