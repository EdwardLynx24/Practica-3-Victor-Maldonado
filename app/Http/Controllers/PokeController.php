<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokeController extends Controller
{
    public function consultarPokemon(Request $request){
        $response = Http::get('https://pokeapi.co/api/v2/pokemon/'.$request->name);
        return $response->json();
    }
    public function habilidadPokemon(Request $request){
        $response = Http::get('https://pokeapi.co/api/v2/ability/'.$request->id);
        return $response->json();
    }
    public function tipoPokemon(Request $request){
        $response = Http::get('https://pokeapi.co/api/v2/type/'.$request->id);
        return $response->json();
    }
}
