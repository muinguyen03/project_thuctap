<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('checkRoleAdmin')) {
    function checkRoleAdmin(): bool
    {
        return Auth::user()->role === 0;
    }
}
