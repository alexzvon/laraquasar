<?php

namespace App\Actions\Dashboard\Color;

use App\Http\Resources\Dashboard\Color\ColorCollection;
use App\Models\Color;

class IndexColorAction
{
    public function __invoke(): array
    {
        return [
            'colors' => ColorCollection::make(Color::query()->orderBy('sort')->orderBy('id')->get()),
        ];
    }
}
