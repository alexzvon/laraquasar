<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Brand\DestroyBrandAction;
use App\Actions\Dashboard\Brand\IndexBrandAction;
use App\Actions\Dashboard\Brand\StoreBrandAction;
use App\Actions\Dashboard\Brand\UpdateBrandAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Brand\StoreRequest;
use App\Http\Requests\Dashboard\Brand\UpdateRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BrandController extends Controller
{
    public function index(IndexBrandAction $action): Response
    {
        return Inertia::render('Dashboard/Brand/Brands', ['brands' => $action()]);
    }

    public function store(StoreRequest $request, StoreBrandAction $action): RedirectResponse
    {
        $action($request);

        return redirect()->intended(route('dashboard.brand.index'));
    }

    public function update(UpdateRequest $request, Brand $brand, UpdateBrandAction $action): RedirectResponse
    {
        $action($request, $brand);

        return redirect()->intended(route('dashboard.brand.index'));
    }

    public function destroy(int $id, DestroyBrandAction $action): RedirectResponse
    {
        $action($id);

        return redirect()->intended(route('dashboard.brand.index'));
    }
}
