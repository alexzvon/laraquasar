<?php

namespace App\Http\Controllers\Auth;

use App\Actions\User\CreateUserAction;
// use App\Models\User;
// use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
// use Illuminate\Support\Facades\Hash;
//use Illuminate\Validation\Rules;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request, CreateUserAction $createUser): RedirectResponse
    {
        $user = $createUser($request->all());

        //event(new Registered($user));

        Auth::login($user);

        return redirect(route('index', absolute: false));
    }
}
