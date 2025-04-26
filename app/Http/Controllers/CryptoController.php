<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CryptoPrice;


class CryptoController extends Controller
{
    public function index()
    {
        // Obtener las primeras 10 criptomonedas más relevantes o las que estén en la base de datos
        $cryptos = CryptoPrice::orderBy('price', 'desc')->take(10)->get();

        // Retornar la vista con las criptomonedas
        return view('index', compact('cryptos'));
    }

    // Lógica para buscar criptomonedas basadas en el input del usuario
    public function search(Request $request)
    {
        $query = $request->get('query'); // Obtiene el término de búsqueda

        // Buscar criptomonedas que coincidan con el nombre de la moneda
        $cryptos = CryptoPrice::where('currency', 'like', '%' . $query . '%')->get();

        return view('index', compact('cryptos'));
    }

}
