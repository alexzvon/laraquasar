<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Actions\Dashboard\Characteristic\IndexAction;
use App\Actions\Dashboard\Characteristic\UpdateAction;
use App\Actions\Dashboard\Characteristic\CreateAction;
use App\Actions\Dashboard\Characteristic\DestroyAction;
use App\Http\Requests\Dashboard\Characteristic\UpdateRequest;
use App\Http\Requests\Dashboard\Characteristic\CreateRequest;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CharacteristicController extends Controller
{
    public function index(int $characteristic_id, IndexAction $action): Response
    {
        // dd($action($characteristic_id)->resolve());
        // dd($action($characteristic_id));

        // $arr = $action($characteristic_id);

        // dump($action($characteristic_id));

        // dump($this->resolve($arr[ 'characterictics' ]));
        // dump($this->resolve($arr[ 'characteristic' ]));
        // dump($this->resolve($arr[ 'types' ]));

        // dump($arr[ 'characterictics' ]());
        // dump($arr[ 'characteristic' ]());
        // dump($arr[ 'types' ]());

        // dd('code');

        return Inertia::render('Dashboard/Characteristics/Index', $action($characteristic_id));
    }

    public function update(UpdateRequest $request, UpdateAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.characteristic.index', $action($request)));
    }

    public function create(CreateRequest $request, CreateAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.characteristic.index', $action($request)));
    }

    public function destroy(int $characteristic_id, DestroyAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.characteristic.index', $action($characteristic_id)));
    }
}
