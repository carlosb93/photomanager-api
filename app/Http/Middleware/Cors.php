<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        return $next($request)
               ->header('Access-control-Allow-Origin', '*')
               ->header('Access-control-Allow-Methods','GET,POST,PUT,DELETE,OPTIONS');
               
    }
}
