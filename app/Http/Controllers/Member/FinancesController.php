<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class FinancesController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Member/Finances');
    }
}
