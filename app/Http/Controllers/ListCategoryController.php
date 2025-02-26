<?php

namespace App\Http\Controllers;

use App\Actions\ListCatalog\IndexListCategoryAction;
use Inertia\Inertia;
use Inertia\Response;

class ListCategoryController extends Controller
{
    public function index(string $slug, IndexListCategoryAction $action): Response
    {
        return Inertia::render('Category', $action($slug));
    }
}
