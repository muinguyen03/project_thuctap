<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user()){
            return redirect()->route('client.home');
        }
        return $next($request);
    }
}
