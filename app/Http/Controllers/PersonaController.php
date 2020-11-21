<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function registrarPersona(Request $request){
        $nuevaPersona = new Persona;
        $nuevaPersona->nombre=$request->nombre;
        $nuevaPersona->apellidoPaterno=$request->apellidoPaterno;
        $nuevaPersona->apellidoMaterno=$request->apellidoMaterno;
        $nuevaPersona->edad=$request->edad;
        $nuevaPersona->sexo=$request->sexo;
        $nuevaPersona->save();
        return response()->json([
            "Persona registrada Exitosamente",
        ],200);
    }
}
