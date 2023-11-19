<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'     => ['bail','required','string'],
            'email'     => ['bail','required','string','email'],
            'password'  => ['bail','required','string','min:6'],
        ];
    }
    public function attributes(): array
    {
        return [
            'name'     => 'Họ và tên',
            'email'     => 'Email',
            'password'  => 'Mật khẩu',
        ];
    }
}
