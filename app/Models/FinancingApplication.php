<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'member_user_id',
        'admin_user_id',
        'tenor',
        'cost_price_total',
        'margin',
        'selling_price_total',
        'monthly_installment',
        'status',
        'application_date',
        'approval_date',
        'rejection_reason',
        'agreement_signed_at',
    ];

    protected $casts = [
        'application_date' => 'datetime',
        'approval_date' => 'datetime',
        'agreement_signed_at' => 'datetime',
        'cost_price_total' => 'decimal:2',
        'margin' => 'decimal:2',
        'selling_price_total' => 'decimal:2',
        'monthly_installment' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    public function installmentBills()
    {
        return $this->hasMany(InstallmentBill::class);
    }
}

