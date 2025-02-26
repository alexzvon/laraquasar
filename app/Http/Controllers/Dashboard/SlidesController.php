<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Sliders\DestroySlidesAction;
use App\Actions\Dashboard\Sliders\IndexSlidesAction;
use App\Actions\Dashboard\Sliders\StoreSlidesAction;
use App\Actions\Dashboard\Sliders\UpdateSlidesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Slide\CreateSlideRequest;
use App\Http\Requests\Dashboard\Slide\UpdateSlideRequest;
// use Redirect;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

// use Redirect;

class SlidesController extends Controller
{
    public function index(IndexSlidesAction $slides): Response
    {
        return Inertia::render('Dashboard/Slides', ['slides' => $slides()]);
    }

    public function store(CreateSlideRequest $request, StoreSlidesAction $action): RedirectResponse
    {
        $action($request);

        return redirect()->intended(route('dashboard.slides.index', absolute: false));
    }

    public function update(UpdateSlideRequest $request, int $id, UpdateSlidesAction $action): RedirectResponse
    {
        $action($request, $id);

        return redirect()->intended(route('dashboard.slides.index', absolute: false));
    }

    public function destroy(int $id, DestroySlidesAction $action): RedirectResponse
    {
        $action($id);

        return redirect()->intended(route('dashboard.slides.index', absolute: false));
    }
}
