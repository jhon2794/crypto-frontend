<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoPriceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'crypto_price_id',
        'price',
        'recorded_at',
    ];


    // Relación con el precio de la criptomoneda
    public function cryptoPrice()
    {
        return $this->belongsTo(CryptoPrice::class);
    }
}
