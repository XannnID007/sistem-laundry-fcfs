<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Linen extends Model
{
    protected $table = 'linens';
    protected $primaryKey = 'linen_id';

    protected $fillable = [
        'nama_linen',
        'satuan',
    ];

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, 'linen_id', 'linen_id');
    }
}
