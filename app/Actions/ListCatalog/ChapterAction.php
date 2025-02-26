<?php

namespace App\Actions\ListCatalog;

use App\Http\Resources\Dashboard\Chapter\ChapterCollection;
use App\Models\Catalog;
use App\Models\Chapter;

class ChapterAction
{
    public function __invoke(string $slug): array
    {
        $catalog = Catalog::query()->firstWhere('slug', $slug);

        return match ($catalog->exists) {
            true => [
                'catalog' => $catalog->toArray(),
                'chapters' => ChapterCollection::make(Chapter::query()->where('catalog_id', $catalog->id)->orderBy('sort')->orderBy('id')->get()),
            ],
            default => [
                'catalog' => [],
                'chapters' => [],
            ]
        };
    }
}
