<?php

namespace App\Http\Controllers;

use App\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class PublicacionController extends Controller
{
    public function crearPublicacion(Request $request){
        if($request->hasFile('file')){
            $path = Storage::disk('public')->putFile('/imagenes/publicaciones',$request->file);
            $nuevaPublicacion = new Publicacion;
            $nuevaPublicacion ->user_id=$request->user_id;
            $nuevaPublicacion ->titulo=$request->titulo;
            $nuevaPublicacion ->cuerpo=$request->cuerpo;
            $nuevaPublicacion ->imagen=$path;
            $nuevaPublicacion ->save();
            return response()->json(["Publicación creada con Exito"],200);
        }
        return response()->json(["¿Sin Foto la publicación?"],400);
    }
}
