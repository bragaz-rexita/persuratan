<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Scospecial
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

        if ( Session('id') != 2 ) {
            return redirect('/');
        }

        return $response;
    }
}

