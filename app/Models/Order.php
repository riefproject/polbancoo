<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_user_id',
        'order_date',
        'status',
        'total_amount',
        'payment_method',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function financingApplication()
    {
        return $this->hasOne(FinancingApplication::class);
    }
}

