<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CryptoPrice;
use Illuminate\Support\Facades\Http;


class CryptoPriceController extends Controller
{
    // Listar todas las criptos
    public function index()
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => '6d9a7674-4c95-441e-bf9e-85b13896132f'
          
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'start' => '1',
            'limit' => '10',
            'convert' => 'USD',
        ]);

        $data = $response->json()['data']; // Esto contiene las monedas

    return view('crypto.index', compact('data'));
        //dd($response->json());
        
        //$cryptos = $response->json()['datos'];
        //return view('cryptos.index', compact('cryptos'));
        //return response()->json(['message' => 'Conexión correcta']);
    }

    // Crear una nueva cripto
    public function store(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        $crypto = CryptoPrice::create([
            'currency' => $request->currency,
            'price' => $request->price,
        ]);

        return response()->json($crypto, 201);
    }

    public function getPrices() {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'start' => 1,
            'limit' => 10,
            'convert' => 'USD'
        ]);
    
        return $response->json();
    }
}
