<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
        header("Access-Control-Allow-Origin: http://192.168.43.110");
       
        $headers = [
        'Access-Control-Allow-Headers'=> 'Origin, Accept, Content-Type, Authorization, Access-Control-Allow-Origin',
        'Access-Control-Allow-Methods'=> 'GET, POST, PUT, DELETE, OPTIONS, HEAD',
        'Access-Control-Allow-Origin: http://192.168.43.110',
];
        if($request->getMethod() == "OPTIONS") {
        
         return response()->make('OK', 200, $headers);
        }

        $response = $next($request);
        
        foreach($headers as $key => $value)
            $response->header($key, $value);
        
        return $response;
    }
}
