<?php

namespace App\Actions\Dashboard\Sliders;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class StoreSlidesAction
{
    public function __invoke($data): void
    {
        $model = Slide::create([
            'name' => $data->name,
            'href' => $data->href,
        ]);

        if (! is_null($data->picture)) {
            $path = Storage::disk('public')->putFileAs(
                'images/slides/'.$model->id,
                $data->picture,
                'slide.'.$data->picture->extension(),
            );

            $model->picture = config('filesystems.disks.public.url').'/'.$path;
            $model->save();
        }
    }
}
