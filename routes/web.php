<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:Super Admin'])->group(function () {
    Route::get('/superadmin/dashboard', function () {
        return Inertia::render('SuperAdmin/Dashboard');
    })->name('superadmin.dashboard');
});

Route::middleware(['auth', 'verified', 'role:Admin,Super Admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/products', function () {
        return Inertia::render('Admin/Products');
    })->name('admin.products');

    Route::get('/admin/members', function () {
        return Inertia::render('Admin/Members');
    })->name('admin.members');

    Route::get('/admin/approvals', function () {
        return Inertia::render('Admin/Approvals');
    })->name('admin.approvals');

    Route::get('/admin/ledger', function () {
        return Inertia::render('Admin/Ledger');
    })->name('admin.ledger');
});

Route::middleware(['auth', 'verified', 'role:Anggota'])->group(function () {
    Route::get('/member/dashboard', function () {
        return Inertia::render('Member/Dashboard');
    })->name('member.dashboard');

    Route::get('/member/cart', function () {
        return Inertia::render('Member/Cart');
    })->name('member.cart');

    Route::get('/member/finances', function () {
        return Inertia::render('Member/Finances');
    })->name('member.finances');

    Route::get('/member/status', function () {
        return Inertia::render('Member/Status');
    })->name('member.status');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
