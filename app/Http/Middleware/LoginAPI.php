<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAPI
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user()){
            return redirect()->route('error-message');
        }
        return $next($request);
    }
}
