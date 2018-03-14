<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware{

    public function handle($request, Closure $next){

        if(!Auth::check()){
            return redirect('login');
        }else{

            if($request->user()->permissao == 2){
                return $next($request);
            }else{
                return redirect()->route('candidato.home');
            }
        }
    }
}
