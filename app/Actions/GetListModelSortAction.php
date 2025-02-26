<?php

namespace App\Actions;

use Illuminate\Support\Collection;

class GetListModelSortAction
{
    public function __invoke(string $model): Collection
    {
        return $model::all()->sortBy('sort')->sortBy('id');
    }
}
