<?php

namespace App\Actions\Dashboard\Color;

use App\Models\Color;
use Illuminate\Support\Facades\Storage;

class StoreColorAction
{
    public function __invoke($data): void
    {
        $pathRoot = config('filesystems.disks.public.url');

        $model = Color::create([
            'title' => $data->title,
            'sort' => $data->sort,
            'picture_image' => '',
        ]);

        if (! is_null($data->picture_image)) {
            $pathImage = Storage::disk('public')->putFileAs(
                '/images/color/'.$model->id,
                $data->picture_image,
                'color.'.$data->picture_image->extension()
            );

            $model->picture_image = $pathRoot.'/'.$pathImage;
            $model->save();
        }
    }
}
