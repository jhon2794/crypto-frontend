<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Console\Commands\FetchCryptoPrices;
use App\Models\CryptoPrice;
use App\Models\CryptoPriceHistory;


class CryptoPrice extends Model
{
    protected $fillable = [
        'currency',
        'price',
    ];
    public static function processFromApi(array $data)

{
    $currency = $data['symbol'];
    $price = $data['quote']['USD']['price'];
    $crypto = self::where('currency', $currency)->first();

    if (!$crypto) {
        // Crear nueva cripto
        self::create([
            'currency' => $currency,
            'price' => $price,
        ]);
    } elseif ($crypto->price != $price) {
        // Actualizar solo si cambió el precio
        $crypto->update([
            'price' => $price,
        ]);
    }

 
}

public function priceHistories()
{
    return $this->hasMany(CryptoPriceHistory::class, 'crypto_price_id');
}
}
