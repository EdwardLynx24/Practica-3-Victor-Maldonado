<?php

namespace App\Http\Middleware;

use Closure;

class ValidarEdad
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
        if($request->edad<=18){
            return abort(403,"You can't Join, Minium Age 18");
        }
        return $next($request);
    }
}
