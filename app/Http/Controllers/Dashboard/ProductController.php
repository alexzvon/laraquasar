<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(int $category_id): Response
    {
        return Inertia::render('Dashboard/Products/ListCategoryProducts', [ 'category_id' => $category_id ]);
    }
}
