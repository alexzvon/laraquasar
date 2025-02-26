<?php

namespace App\Http\Controllers;

use App\Actions\Dashboard\Catalog\IndexCatalogAction;
use App\Actions\ListCatalog\CategoryAction;
use App\Actions\ListCatalog\ChapterAction;
use Inertia\Inertia;
use Inertia\Response;

class ListCatalogController extends Controller
{
    public function index(IndexCatalogAction $action): Response
    {
        return Inertia::render('ListCatalog', ['catalogs' => $action()]);
    }

    public function chapter(string $slug, ChapterAction $action): Response
    {
        return Inertia::render('ListChapter', $action($slug));
    }

    public function category(string $catalog_slug, string $chapter_slug, CategoryAction $action): Response
    {
        return Inertia::render('ListCategory', $action($catalog_slug, $chapter_slug));
    }
}
