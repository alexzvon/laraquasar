<?php

namespace App\Actions\Dashboard\Dimension;

use App\Http\Resources\Dashboard\Dimension\DimensionCollection;
use App\Models\Dimension;

class IndexDimensionAction
{
    public function __invoke(): array
    {
        return ['dimensions' => DimensionCollection::make(Dimension::query()->orderBy('sort')->orderBy('id')->get())];
    }
}
