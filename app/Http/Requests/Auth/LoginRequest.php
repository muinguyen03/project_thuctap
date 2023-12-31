<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    public function rules(): array
    {
        return [
            'email'     => ['bail','required','string','email'],
            'password'  => ['bail','required','string','min:1'],
        ];
    }
    public function attributes(): array
    {
        return [
            'email'     => 'Email',
            'password'  => 'Mật khẩu',
        ];
    }
}
