<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    public function guardarImagen(Request $request){
            if($request->hasFile('file')){
            $path = Storage::disk('public')->putFile('imagenes/',$request->file);
            return response()->json(["Path"=>$path],201); 
        }
        return response()->json(NULL,400);
    }   
}
