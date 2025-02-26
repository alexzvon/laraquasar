<?php

namespace App\Actions\Dashboard\Color;

use App\Models\Color;
use Illuminate\Support\Facades\Storage;

class UpdateColorAction
{
    public function __invoke($data, $id): void
    {
        $pathRoot = config('filesystems.disks.public.url');

        if (! is_null($data->picture_image)) {
            if (is_dir($pathRoot.'/images/color/'.$id)) {
                Storage::disk('public')->deleteDirectory('/images/color/'.$id);
            }

            $pathImage = Storage::disk('public')->putFileAs(
                '/images/color/'.$id,
                $data->picture_image,
                'color.'.$data->picture_image->extension()
            );

            $picture_image = $pathRoot.'/'.$pathImage;
        } else {
            $picture_image = '';
        }

        Color::query()->where('id', $id)->update([
            'title' => $data->title,
            'sort' => $data->sort,
            'picture_image' => $picture_image,
        ]);
    }
}
