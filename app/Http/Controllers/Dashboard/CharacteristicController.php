<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Characteristic;
use App\Actions\Dashboard\Characteristic\UpdateAction;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class CharacteristicController extends Controller
{
    public function update(Request $request, UpdateAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.category.index', $action($request)));
    }

    
}
