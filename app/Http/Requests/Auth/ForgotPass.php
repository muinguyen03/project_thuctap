<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class ForgotPass extends Request
{
    public function rules(): array
    {
        return [
            'email'     => ['bail','required','string','email'],
        ];
    }
    public function attributes(): array
    {
        return [
            'email'     => 'Email',
        ];
    }
}
