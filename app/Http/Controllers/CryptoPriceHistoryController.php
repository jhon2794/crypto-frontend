<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CryptoPriceHistory;

class CryptoPriceHistoryController extends Controller
{
    // Listar todos los historiales
    public function index()
    {
        return CryptoPriceHistory::with('cryptoPrice')->get();
    }

    // Crear un nuevo historial
    public function store(Request $request)
    {
        $request->validate([
            'crypto_price_id' => 'required|exists:crypto_prices,id',
            'price' => 'required|numeric',
            'recorded_at' => 'required|date'
        ]);

        $history = CryptoPriceHistory::create([
            'crypto_price_id' => $request->crypto_price_id,
            'price' => $request->price,
            'recorded_at' => $request->recorded_at
        ]);

        return response()->json($history, 201);
    }

    
}
