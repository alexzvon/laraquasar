<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Actions\Dashboard\Product\IndexAction;
use App\Actions\Dashboard\Product\StoreAction;
use App\Actions\Dashboard\Product\UpdateAction;
use App\Actions\Dashboard\Product\DestroyAction;
use App\Http\Requests\Dashboard\Product\IndexRequest;
use App\Http\Requests\Dashboard\Product\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(int $category_id, int $product_id, IndexAction $action): Response
    {
        return Inertia::render('Dashboard/Products/ListCategoryProducts', $action($category_id, $product_id));
    }

    public function store(IndexRequest $request, StoreAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.product.index', $action($request->all())));
    }

    public function update(UpdateRequest $request, UpdateAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.product.index', $action($request->all())));
    }

    public function destroy(int $category_id, int $product_id, DestroyAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.product.index', $action($category_id, $product_id)));
    }
}
