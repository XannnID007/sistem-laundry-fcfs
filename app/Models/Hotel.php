<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    protected $table = 'hotels';
    protected $primaryKey = 'hotel_id';

    protected $fillable = [
        'nama_hotel',
        'alamat',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'hotel_id', 'hotel_id');
    }
}
