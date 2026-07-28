<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckAuthProjectBankSoal
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
            return redirect('/');
        }
        return $response;
    }
}
