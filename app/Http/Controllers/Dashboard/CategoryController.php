<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Category\AppendAction;
use App\Actions\Dashboard\Category\CreateAction;
use App\Actions\Dashboard\Category\DestroyAction;
use App\Actions\Dashboard\Category\IndexAction;
use App\Actions\Dashboard\Category\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CreateRequest;
use App\Http\Requests\Dashboard\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Characteristic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(int $category_id, int $characteristic_id, IndexAction $action): Response
    {
        return Inertia::render('Dashboard/Category/Category', $action($category_id, $characteristic_id));
    }

    public function append(Category $category, CreateRequest $request, AppendAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.category.index', $action($category, $request)));
    }

    public function create(Category $category, CreateRequest $request, CreateAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.category.index', $action($category, $request)));
    }

    public function update(Category $category, UpdateRequest $request, UpdateAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.category.index', $action($category, $request)));
    }

    public function destroy(int $id, DestroyAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.category.index', $action($id)));
    }

    public function proba(Category $category, Characteristic $characteristic, Request $request): RedirectResponse
    {
        // dump($category);
        // dump($characteristic);
        // dump($category->characteristics());
        // dump($category->characteristics->find(55));
        // dump($category->characteristics->find(555));

        // dd('code');

        // sleep(5);

        return redirect()->intended(route('dashboard.category.index', 
        [ 'category_id' => $category->id, 'characteristic_id' => $characteristic->id ]));
    }

}
