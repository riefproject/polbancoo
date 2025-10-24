<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response|RedirectResponse
    {
        $user = request()->user();

        if ($user?->hasRole('Super Admin')) {
            return redirect()->route('superadmin.dashboard');
        }

        if ($user?->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user?->hasRole('Anggota')) {
            return redirect()->route('member.dashboard');
        }

        return Inertia::render('Dashboard');
    }
}
