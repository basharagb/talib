<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_type',
        'type',
        'status',
        'start_date',
        'end_date',
        'expires_at',
        'amount',
        'payment_method',
        'payment_status',
        'payment_reference',
        'paid_at',
        'payment_notes',
        'auto_approved',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'expires_at' => 'datetime',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'auto_approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
