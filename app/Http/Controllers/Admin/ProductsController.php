<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ProductsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Products');
    }
}
