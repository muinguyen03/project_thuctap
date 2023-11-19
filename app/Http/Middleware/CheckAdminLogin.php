<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminLogin
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user()){
            return redirect()->route('auth.login');
        }
        else if(Auth::user()->role != 0 && Auth::user()->role != 1){
            return redirect()->route('client.home');
        }
        return $next($request);
    }
}
