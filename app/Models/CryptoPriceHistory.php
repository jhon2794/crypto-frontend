<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CryptoPrice;
use App\Models\CryptoPriceHistory;

class CryptoPriceHistory extends Model
{
    protected $fillable = [
        'crypto_price_id',
        'price',
        'recorded_at',
    ];

    /**
     * Actualiza el historial de precios.
     */
    public static function updateHistory()
    {
        // Obtenemos todas las criptomonedas actualizadas en la tabla crypto_prices
        $cryptos = \App\Models\CryptoPrice::all();

        foreach ($cryptos as $crypto) {
            // Verificamos si el historial ya existe con el mismo precio
            $existingHistory = self::where('crypto_price_id', $crypto->id)
                                    ->where('price', $crypto->price)
                                    ->first();

            // Si no existe el historial con el precio actual, lo guardamos
            if (!$existingHistory) {
                self::create([
                    'crypto_price_id' => $crypto->id,
                    'price' => $crypto->price,
                    'recorded_at' => now(),
                ]);
            }
        }
    }

    /**
     * Relación con el precio de la criptomoneda.
     */
    public function cryptoPrice()
    {
        return $this->belongsTo(CryptoPrice::class, 'crypto_price_id');
    }
}

