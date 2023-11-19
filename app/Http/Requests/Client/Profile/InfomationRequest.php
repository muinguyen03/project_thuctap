<?php

namespace App\Http\Requests\Client\Profile;

use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InfomationRequest extends Request
{
    public function rules()
    {
        return [
            'name' => ['bail', 'required', 'string',],
            'email' => [ 'bail', 'required', 'string',
                Rule::unique(User::class, $this->column_id)->ignore(Auth::user()->email),
            ],
            'phone' => [ 'bail', 'required', 'string',
                Rule::unique(User::class,  $this->column_id)->ignore(Auth::user()->phone),
            ],
        ];
    }
}
