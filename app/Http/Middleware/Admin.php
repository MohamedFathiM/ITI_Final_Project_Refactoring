<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if(Auth::check()){
            if(auth()->user()->role==0){
                return $next($request);
            }else{        
                return redirect('/')->with('error','you don\'t have admin access');
            }
        }else{
            return redirect('login');
        }
    }
}
