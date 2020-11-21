<?php

namespace App\Http\Controllers;

use App\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ComentarioController extends Controller
{
    public function registrarComentario(Request $request){
        $nuevoComentario = new Comentario;
        $nuevoComentario ->user_id=$request->user_id;
        $nuevoComentario ->publicacion_id=$request->publicacion_id;
        $nuevoComentario ->comentario=$request->comentario;
        $idUser = $request->user_id;
        $idPubli = $request->publicacion_id;
        $texto = $request->comentario;
        $nuevoComentario ->save();
        ComentarioController::enviarEmail($idUser);
        ComentarioController::enviarCorreoPublicacion($idUser,$idPubli,$texto);
        return response()->json(["Nuevo Comentario Generado Exitosamente"],200);
    }
    public static function enviarEmail($idUser){
        $comentario = DB::table('users')->select('email')->where('id','=',$idUser)->first();
        $nick = DB::table('users')->select('nickname')->where('id','=',$idUser)->first();
        $data = Array(
            'nickname'=>$nick->nickname

        );
        Mail::send('nuevoComentario',$data, function($message) use ($comentario){
            $message->from('17050039@uttcampus.edu.mx'); 
            $message->to($comentario->email)->subject('Comentario Nuevo');
        });
        return "Tu correo se envio.";
    }
    //Enviar correo cuando se realice un comentario al propetiario de la publicacion
    public static function enviarCorreoPublicacion($publicacion, $usuario, $comentario){
        $infoPublicacion = DB::table('publicacions')->where('id','=',$publicacion)->first();
        $autor = DB::table('users')->select('email')->where('id','=',$infoPublicacion->user_id)->first();
        $data = array(
            'titulo' => $infoPublicacion->titulo,
            'cuerpo' => $infoPublicacion->cuerpo,
            'usuario' => $usuario,
            'comentario' => $comentario
            );
            Mail::send('notificacion', $data, function ($message) use ($autor){
                $message->from('17050039@uttcampus.edu.mx', 'Notificacion');
                $message->to($autor->email)->subject('Notificacion');
            });
    }
}
