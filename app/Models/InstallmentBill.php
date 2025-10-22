<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'financing_application_id',
        'bill_number',
        'amount',
        'due_date',
        'payment_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
        'payment_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function financingApplication()
    {
        return $this->belongsTo(FinancingApplication::class);
    }
}

