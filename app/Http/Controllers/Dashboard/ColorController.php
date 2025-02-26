<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Color\DestroyColorAction;
use App\Actions\Dashboard\Color\IndexColorAction;
use App\Actions\Dashboard\Color\StoreColorAction;
use App\Actions\Dashboard\Color\UpdateColorAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Color\StoreRequest;
use App\Http\Requests\Dashboard\Color\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ColorController extends Controller
{
    public function index(IndexColorAction $action): Response
    {
        return Inertia::render('Dashboard/Color/Colors', $action());
    }

    public function store(StoreRequest $request, StoreColorAction $action): RedirectResponse
    {
        $action($request);

        return redirect()->intended(route('dashboard.color.index'));
    }

    public function update(UpdateRequest $request, int $id, UpdateColorAction $action): RedirectResponse
    {
        $action($request, $id);

        return redirect()->intended(route('dashboard.color.index'));
    }

    public function destroy(int $id, DestroyColorAction $action): RedirectResponse
    {
        $action($id);

        return redirect()->intended(route('dashboard.color.index'));
    }
}
