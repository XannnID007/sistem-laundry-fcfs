<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'user_id',
        'tgl_transaksi',
        'status',
        'total_qty',
    ];

    protected $casts = [
        'tgl_transaksi' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'transaction_id');
    }

    // Scope untuk implementasi FCFS - mengurutkan berdasarkan waktu transaksi
    public function scopeFcfsOrder($query)
    {
        return $query->orderBy('tgl_transaksi', 'asc');
    }
}
