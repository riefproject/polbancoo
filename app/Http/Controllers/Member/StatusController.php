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

        // Hitung ringkasan status pengajuan
        $statusSummary = [
            'Pending' => $applications->where('status', 'Pending')->count(),
            'Approved' => $applications->where('status', 'Approved')->count(),
            'Rejected' => $applications->where('status', 'Rejected')->count(),
            'Active' => $applications->where('status', 'Active')->count(),
            'Lunas' => $applications->where('status', 'Lunas')->count(),
        ];

        // Kirim data ke halaman Vue 'Member/Status'
        return Inertia::render('Member/Status', [
            'applications' => $applications,
            'statusSummary' => $statusSummary,
        ]);
    }
}
