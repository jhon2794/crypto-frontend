<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CryptoPrice;
use App\Models\CryptoPriceHistory;


class FetchCryptoPrices extends Command
{
    protected $signature = 'crypto:fetch-prices';
    protected $description = 'Fetch current crypto prices and update database';

    public function handle()
    {
        $this->info('Fetching crypto prices...');

        try {
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY'),
            ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
                'start' => 1,
                'limit' => 100,
                'convert' => 'USD',
            ]);

            if ($response->failed()) {
                $this->error('Error en la API. Código de respuesta: ' . $response->status());
            }

            if ($response->successful()) {
                $cryptos = $response->json('data');

                foreach ($cryptos as $data) {
                    CryptoPrice::processFromApi($data);
                    
                }
                

                $this->info('Crypto prices updated successfully.');
            } else {
                $this->error('Failed to fetch data from CoinMarketCap API.');
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
         // Aquí pones la lógica para actualizar los precios históricos de las criptomonedas
         CryptoPriceHistory::updateHistory();
         $this->info('Crypto price history updated successfully!');
    }
   
}
