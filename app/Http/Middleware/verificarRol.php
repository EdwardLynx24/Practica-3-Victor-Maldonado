<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 

class verificarRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->user()->tokenCan('user')){
            $usuario = $request->user()->email;
            $url = $request->url();
            verificarRol::enviarCorreo($usuario,$url);
            return abort(401);
        }
        return $next($request);
    }
    public static function enviarCorreo($usuario, $url){
        $correosAdmin = DB::table('users')->select('email')->where('rol','=','Usuario')->get();
        foreach ($correosAdmin as $admin) {
            $data = array(
            'usuario' => $usuario,
            'url' => $url
            );
            Mail::send('correoFallaAcceso', $data, function ($message) use ($admin){
                $message->from('17050039@uttcampus.edu.mx', 'Acceso Denegado');
                $message->to($admin->email)->subject('Usuario sin acceso Administrador');
            });
        }

    }
}