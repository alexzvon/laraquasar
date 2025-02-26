<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Category\AppendCategoryAction;
use App\Actions\Dashboard\Category\CreateCategoryAction;
use App\Actions\Dashboard\Category\DestroyCategoryAction;
use App\Actions\Dashboard\Category\IndexCategoryAction;
use App\Actions\Dashboard\Category\UpdateCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CreateRequest;
use App\Http\Requests\Dashboard\Category\UpdateRequest;
// use App\Http\Resources\Dashboard\Category\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(Category $category, IndexCategoryAction $action): Response
    {
        return Inertia::render('Dashboard/Category/Category', $action($category));
    }

    public function append(Category $category, CreateRequest $request, AppendCategoryAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.category.index', ['id' => $action($category, $request)]));
    }

    public function create(Category $category, CreateRequest $request, CreateCategoryAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.category.index', ['id' => $action($category, $request)]));
    }

    // public function show(int $id, ShowCategoryAction $action): Response
    // {
    //     return Inertia::render('Dashboard/Category/', [
    //         'chapter_id' => $id,
    //         'categories' => CategoryCollection::make($action($id)),
    //     ]);
    // }

    public function update(Category $category, UpdateRequest $request, UpdateCategoryAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.category.index', ['id' => $action($category, $request)]));
    }

    public function destroy(int $id, DestroyCategoryAction $action): RedirectResponse
    {
        $action($id);

        return redirect()->intended(route('dashboard.category.index', ['id' => 1]));
    }
}
