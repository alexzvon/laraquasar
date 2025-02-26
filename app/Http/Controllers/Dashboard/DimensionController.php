<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Dimension\DestroyAction;
use App\Actions\Dashboard\Dimension\IndexDimensionAction;
use App\Actions\Dashboard\Dimension\StoreAction;
use App\Actions\Dashboard\Dimension\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Dimension\StoreRequest;
use App\Http\Requests\Dashboard\Dimension\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class DimensionController extends Controller
{
    public function index(IndexDimensionAction $action): Response
    {
        return Inertia::render('Dashboard/Dimension/Dimensions', $action());
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action($request);

        return redirect()->intended(route('dashboard.dimension.index'));
    }

    public function update(UpdateRequest $request, int $id, UpdateAction $action): RedirectResponse
    {
        $action($request, $id);

        return redirect()->intended(route('dashboard.dimension.index'));
    }

    public function destroy(int $id, DestroyAction $action): RedirectResponse
    {
        $action($id);

        return redirect()->intended(route('dashboard.dimension.index'));
    }
}
