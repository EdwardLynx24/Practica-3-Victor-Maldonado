<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function registrarUsuario(Request $request){
        $nuevoUsuario = new User;
        if($request->hasFile('file')){
            $path = Storage::disk('public')->putFile('/imagenes',$request->file);
            $nuevoUsuario ->persona_id=$request->persona_id;
            $nuevoUsuario ->nickname=$request->nickname;
            $nuevoUsuario ->email=$request->email;
            $nuevoUsuario ->password=$request->password;
            $nuevoUsuario ->rol=$request->rol;
            $nuevoUsuario ->fotoPerfil=$path;
            $nuevoUsuario ->save();
            UserController::enviarEmail($request);
            return response()->json(["Usuario registrado Exitosamente, favor de verificar su cuenta"],200);
        }
        return response()->json(["¿Sin foto de perfil?"],400);
    }
    public static function enviarEmail(Request $request){
        $data = Array(
            'correo'=>$request->email,
        );
        Mail::send('verificacion',$data, function($message) use ($request){
            $email =$request->email;
            $message->from('17050039@uttcampus.edu.mx'); 
            $message->to($request->email)->subject('Activar Cuenta');
        });
        return "Tu correo se envio.";
    }
    public function verificarCuenta(string $correo){
        $usuarioVerificado = User::where('email',$correo)->first();
        if($usuarioVerificado){
            $usuarioVerificado->email_verified_at = NOW();
            $usuarioVerificado->save();
            return response()->json(["Cuenta Activada"],200);
        }
        return abort('No se pudo verificar',400);
    }
    public function iniciarSesion(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $usuario = User::where('email', $request->email)->first();
        /*if(! $usuario || ! Hash::check($request->password, $usuario->password)){
            return abort(401,'Credenciales erroneas');
        }*/
        if($usuario->rol == "Administrador"){
            $token = $usuario->createToken($request->email,['admin'])->plainTextToken;
        }elseif ($usuario->rol == "Usuario") {
            $token = $usuario->createToken($request->email,['user'])->plainTextToken;
        }
        return response()->json(["token"=>$token],200);
    }
    public function cerrarSesion(Request $request){
        return response()->json(["Tokens Eliminados"=>$request->user()->tokens()->delete()],200);
    }
    public function verPerfil(Request $request){
        return response()->json(["request"=>$request->all(),
        "Persona"=>($request->id==0)?\App\Persona::all():\App\Persona::find($request->id),
        200]);
    }
}
