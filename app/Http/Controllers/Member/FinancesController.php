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

        // Nominal Simpanan //
        $simpanan = SavingsAccount::where('member_user_id', $user->id)->get();
        $simpananWajib = $simpanan->sum('mandatory_saving');
        $simpananPokok = $simpanan->sum('principal_saving');
        $simpananSukarela = $simpanan->sum('voluntary_saving');
        $totalSimpanan = $simpananWajib + $simpananPokok + $simpananSukarela;

        // History Simpanan (Tanggal)//
        $savingsAccount = SavingsAccount::where('member_user_id', $user->id)->first();
        $history = SavingsTransaction::where('savings_account_id', $savingsAccount->id)
            ->whereNotNull('admin_user_id')
            ->orderBy('transaction_date', 'desc')
            ->get();
        $mandatoryHistory = $history->where('type', 'Mandatory');
        $principalHistory = $history->where('type', 'Principal');
        $voluntaryHistory = $history->where('type', 'Voluntary');
        $historypokok = optional($principalHistory->first())->transaction_date;
        $historywajib = optional($mandatoryHistory->first())->transaction_date;
        $historysukarela = optional($voluntaryHistory->first())->transaction_date;


        // History Simpanan (Jumlah) //
        $nominalhistorypokok = SavingsTransaction::where('savings_account_id', $savingsAccount->id)
            ->where('type', 'Principal')
            ->whereNotNull('admin_user_id')
            ->orderByDesc('transaction_date')
            ->value('amount');
        $nominalhistorywajib = SavingsTransaction::where('savings_account_id', $savingsAccount->id)
            ->where('type', 'Mandatory')
            ->whereNotNull('admin_user_id')
            ->orderByDesc('transaction_date')
            ->value('amount');
        $nominalhistorysukarela = SavingsTransaction::where('savings_account_id', $savingsAccount->id)
            ->where('type', 'Voluntary')
            ->whereNotNull('admin_user_id')
            ->orderByDesc('transaction_date')
            ->value('amount');

        // Kirim Data Ke Vue //
        return Inertia::render('Member/Finances', [
            'totalSaldo' => $totalSimpanan,
            'simpanan' => [
                'pokok' => $simpananPokok,
                'wajib' => $simpananWajib,
                'sukarela' => $simpananSukarela,
            ],
            'lastUpdate' => now()->locale('id')->translatedFormat('d F Y'),
            'historytanggalsimpanan' => [
                'historypokok' => $historypokok ? \Carbon\Carbon::parse($historypokok)->locale('id')->translatedFormat('d F Y') : null,
                'historywajib' => $historywajib ? \Carbon\Carbon::parse($historywajib)->locale('id')->translatedFormat('d F Y') : null,
                'historysukarela' => $historysukarela ? \Carbon\Carbon::parse($historysukarela)->locale('id')->translatedFormat('d F Y') : null,
            ],
            'historynominalsimpanan' => [
                'nominalhistorypokok' => $nominalhistorypokok,
                'nominalhistorywajib' => $nominalhistorywajib,
                'nominalhistorysukarela' => $nominalhistorysukarela
            ]
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
            'description' => $request->description?: '',
            'transaction_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil dikirim dan menunggu persetujuan admin.');
    }
}
