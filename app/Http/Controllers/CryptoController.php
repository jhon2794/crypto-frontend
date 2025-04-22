<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CryptoController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => 'TU_API_KEY',
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'start' => '1',
            'limit' => '10',
            'convert' => 'USD',
        ]);

        $cryptos = $response->json()['data'];

        //return view('cryptos.index', compact('cryptos'));
        return response()->json(['message' => 'Conexión correcta']);
    }
}
