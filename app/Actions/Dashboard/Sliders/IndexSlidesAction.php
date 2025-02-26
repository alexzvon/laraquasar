<?php

namespace App\Actions\Dashboard\Sliders;

use App\Models\Slide;

class IndexSlidesAction
{
    public function __invoke(): array
    {
        return Slide::orderBy('id')->get()->toArray();
    }
}
