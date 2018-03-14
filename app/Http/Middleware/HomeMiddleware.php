<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HomeMiddleware{
    
    public function handle($request, Closure $next){

        if(Auth::check()){
            return redirect()->route('candidato.home');
        }else{
            return $next($request);
        }
    }
}
