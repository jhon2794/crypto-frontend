<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\CryptoPrice;
use App\Models\CryptoPriceHistory;

class UpdateCryptoPricesHistory extends Command
{
    protected $signature = 'crypto:update-history'; // Aquí defines el comando que puedes ejecutar
    protected $description = 'Update cryptocurrency price history from the database'; // Descripción del comando

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        CryptoPriceHistory::updateHistory();
        $this->info('Crypto price history updated successfully!');
    }
}