<?php

namespace App\Actions\Dashboard\Sliders;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class UpdateSlidesAction
{
    public function __invoke($data, $id): void
    {
        $update = [
            'name' => $data->name,
            'href' => $data->href,
        ];

        if (! is_null($data->picture)) {
            Storage::disk('public')->deleteDirectory('images/slides/'.$id);

            $path = Storage::disk('public')->putFileAs(
                'images/slides/'.$id,
                $data->picture,
                'slide.'.$data->picture->extension(),
            );

            $update['picture'] = config('filesystems.disks.public.url').'/'.$path;
        }

        Slide::whereId($id)->update($update);
    }
}
