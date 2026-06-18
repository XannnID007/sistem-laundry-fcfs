<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'transaction_id',
        'linen_id',
        'no_room',
        'qty',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    public function linen(): BelongsTo
    {
        return $this->belongsTo(Linen::class, 'linen_id', 'linen_id');
    }
}
