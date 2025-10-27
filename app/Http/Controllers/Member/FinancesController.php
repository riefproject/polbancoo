<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Finances;
use App\Models\SavingsAccount;
use App\Models\SavingsTransaction;
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

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Mandatory,Voluntary',
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Ambil Akun Simpanan Milik User //
        $savingsAccount = SavingsAccount::where('member_user_id', $user->id)->firstOrFail();

        // Simpan transaksi ke tabel savings_transactions //
        SavingsTransaction::create([
            'savings_account_id' => $savingsAccount->id,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
            'transaction_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil dikirim dan menunggu persetujuan admin.');
    }
}
