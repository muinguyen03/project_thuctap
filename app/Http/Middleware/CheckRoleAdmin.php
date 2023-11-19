<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role != 0){
            return redirect()->route('permission-denied');
        }
        return $next($request);
    }
}
