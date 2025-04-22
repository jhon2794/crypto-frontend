<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CryptoPrice;

class FetchCryptoPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crypto:fetch-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => env('COINMARKET_API_KEY'),
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'start' => 1,
            'limit' => 5, 
            'convert' => 'USD',
        ]);
    
        $data = $response->json()['data'];
    
        foreach ($data as $crypto) {
            \App\Models\CryptoPrice::create([
                'currency' => $crypto['symbol'],
                'price' => $crypto['quote']['USD']['price'],
            ]);
        }
    
        $this->info('Precios de criptomonedas guardados exitosamente.');
    }
}
