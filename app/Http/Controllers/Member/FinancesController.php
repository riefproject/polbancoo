<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Finances;
use App\Models\SavingsAccount;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FinancesController extends Controller
{
    public function index(): Response
    {
        $user = Auth::user();

        $simpanan = SavingsAccount::where('member_user_id', $user->id)->get();

        $simpananWajib = $simpanan->sum('mandatory_saving');
        $simpananPokok = $simpanan->sum('principal_saving');
        $simpananSukarela = $simpanan->sum('voluntary_saving');

        $totalSimpanan = $simpananWajib + $simpananPokok + $simpananSukarela;
        return Inertia::render('Member/Finances', [
            'totalSaldo' => $totalSimpanan,
            'simpanan' => [
                'pokok' => $simpananPokok,
                'wajib' => $simpananWajib,
                'sukarela' => $simpananSukarela,
            ],
            'lastUpdate' => now()->locale('id')->translatedFormat('d M Y'),
        ]);
    }
}
