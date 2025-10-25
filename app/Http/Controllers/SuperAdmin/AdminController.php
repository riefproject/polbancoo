<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\StoreAdminRequest;
use App\Http\Requests\SuperAdmin\UpdateAdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter hanya user dengan role 'Admin' dan eager load relasi roles
        $query->whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->with('roles');

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $admins = $query->paginate(10)->withQueryString();

        return Inertia::render('SuperAdmin/Admins/Index', [
            'admins' => $admins,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('SuperAdmin/Admins/Create');
    }

    public function store(StoreAdminRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $role = Role::firstOrCreate(['name' => 'Admin']);
        $user->roles()->attach($role);

        return redirect()->route('superadmin.admins.index')->with('message', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);

        if (!$user->roles->contains('name', 'Admin')) {
            abort(404, 'User not found or not an admin.');
        }

        return Inertia::render('SuperAdmin/Admins/Edit', [
            'admin' => $user,
        ]);
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $user = User::with('roles')->findOrFail($id);

        if (!$user->roles->contains('name', 'Admin')) {
            abort(404, 'User not found or not an admin.');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return redirect()->route('superadmin.admins.index')->with('message', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::with('roles')->findOrFail($id);

        if (!$user->roles->contains('name', 'Admin')) {
            abort(404, 'User not found or not an admin.');
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('superadmin.admins.index')->with('message', 'Admin deleted successfully.');
    }
}