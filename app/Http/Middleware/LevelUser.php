<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LevelUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->level == 'penjual'){
            return $next($request);
        }
        return response()->json(['message'=>'maaf anda bukan penjual']);
    }
}
