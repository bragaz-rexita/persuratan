<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckAuthProjectRekrutmen
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
        $response   =   $next($request);
        if ( !$request->session()->has('fakultas')) {
            return redirect('/rekrutmen');
        }
        return $response;
    }
}
