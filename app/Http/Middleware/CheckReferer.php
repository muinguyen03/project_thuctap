<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckReferer
{
    public function handle(Request $request, Closure $next)
    {
        $referer = $request->headers->get('url_request');
        $allowedReferer = env('FE_CLIENT_LOGIN');
        if (!$referer || !str_starts_with($referer, $allowedReferer)) {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthorized access'
            ],403);
        }
        return $next($request);
    }
}
