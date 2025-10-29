<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
			// provide the authenticated user and related member profile
			'user' => $user,
			'member' => optional($user)->memberProfile,
		]);
	}
}

