<?php

namespace App\Actions\Dashboard\Brand;

use App\Http\Resources\Dashboard\Brand\BrandCollection;
use App\Models\Brand;

class IndexBrandAction
{
    public function __invoke(): BrandCollection
    {
        return BrandCollection::make(Brand::orderBy('id')->get());
    }
}
