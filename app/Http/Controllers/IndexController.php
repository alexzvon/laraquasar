<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Slide;

class IndexController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('StartIndex', [ 'slides' => Slide::orderBy('id')->get() ]);
    }

}
