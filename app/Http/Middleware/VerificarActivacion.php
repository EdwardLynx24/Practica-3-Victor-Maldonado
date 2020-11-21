<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class VerificarActivacion
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
        $verificacion = \App\User::where('email',$request->email)->first();
        if($verificacion){
            if($verificacion->email_verified_at==NULL){
                return abort(403,'No has activado tu cuenta');
            }
        }
        return $next($request);
    }
}
