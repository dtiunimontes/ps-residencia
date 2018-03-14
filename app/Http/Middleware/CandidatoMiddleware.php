<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CandidatoMiddleware{

    public function handle($request, Closure $next){

        if(!Auth::check()){
            return redirect('login');
        }else{

            if($request->user()->permissao == 2){
                return redirect()->route('admin.home');
            }else{
                return $next($request);
            }
        }
    }
}
