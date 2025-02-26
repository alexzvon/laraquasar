<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\User\DestroyUserAction;
use App\Actions\Dashboard\User\GetListUserAction;
use App\Actions\Dashboard\User\StoreUserAction;
use App\Actions\Dashboard\User\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\StoreRequest;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Http\Resources\Dashboard\User\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(GetListUserAction $action): Response
    {
        return Inertia::render('Dashboard/Users/ListUser', [
            'rows' => $action(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Dashboard/Users/CreateUser');
    }

    public function store(StoreRequest $request, StoreUserAction $storeUser): RedirectResponse
    {
        $user = $storeUser($request);

        return redirect()->intended(route('dashboard.users.index', absolute: false));
    }

    public function show(string $id): Response
    {
        return Inertia::render('Dashboard/Users/ListUsers');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Dashboard/Users/EditUser', [
            'user' => UserResource::make($user),
        ]);
    }

    public function update(User $user, UpdateRequest $request, UpdateUserAction $action): RedirectResponse
    {
        $action($user, $request);

        return redirect()->intended(route('dashboard.users.index', absolute: false));
    }

    public function destroy(User $user, DestroyUserAction $action): RedirectResponse
    {
        $action($user);

        return redirect()->intended(route('dashboard.users.index', absolute: false));
    }
}
