<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\FinancingApplication;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class StatusController extends Controller
{
    public function __invoke(): Response
    {
        // Ambil data pengajuan pembiayaan anggota yang sedang login
        $applications = FinancingApplication::where('member_user_id', Auth::id())
            ->with('order')
            ->get(['id', 'order_id', 'tenor', 'status', 'selling_price_total']);

        // Kirim data ke halaman Vue 'Member/Status'
        return Inertia::render('Member/Status', [
            'applications' => $applications,
        ]);
    }
}
