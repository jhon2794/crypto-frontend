<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency',
        'price',
       
    ];

    // Relación: Un precio de criptomoneda puede tener muchos historiales
    public function histories()
    {
        return $this->hasMany(CryptoPriceHistory::class);
    }
    
}
