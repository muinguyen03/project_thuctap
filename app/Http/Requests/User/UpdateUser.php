<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Validation\Rule;


class UpdateUser extends Request
{

    protected function prepareForValidation():void
    {
        $this->merge(['user' => $this->route('user')]);
    }

    public function rules(): array
    {
        if (!User::find($this->user)) {
            return [
                'user' => [
                    'bail', 'required',
                    Rule::exists(User::class, $this->column_id)
                ],
            ];
        }
        return [
            'name' => [
                'bail','required','string',
            ],
            'email' => [
                'bail','required', 'string','email',
                Rule::unique(User::class)->ignore($this->user,$this->column_id),
            ],
            'phone' => [
                'bail','required', 'regex:/^([0-9\s\-\+\(\)]*)$/','max: 10','min:10',
                Rule::unique(User::class, 'phone')->ignore($this->user,$this->column_id),
            ],
            'address' => [ 'required' ],


        ];
    }
    public function attributes(): array
    {
        return [
            'name' => ' Họ và Tên ',
            'email' => 'Email',
            'phone' => 'Số điện thoại ',
            'address' => 'Địa chỉ ',
        ];
    }
}
