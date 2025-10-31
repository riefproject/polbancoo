<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the member's profile (read-only).
     */
    public function __invoke(Request $request): Response
    {
        $user = $request->user();

        return Inertia::render('Member/Profile', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar_url' => $user->avatar ? asset('storage/' . $user->avatar) : null,
            ],
            'member' => optional($user)->memberProfile,
        ]);
    }

    /**
     * Upload avatar for the authenticated user.
     */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        $user = $request->user();

        // Hapus foto lama jika ada
        if ($user->avatar) {
            $fullPath = storage_path('app/public/' . $user->avatar);
            
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
        }

        // Simpan foto baru
        $path = $request->file('avatar')->store('avatars', 'public');

        // Update kolom avatar di database
        $user->update(['avatar' => $path]);

        return redirect()->back()->with('message', 'Foto profil berhasil diperbarui.');
    }
}