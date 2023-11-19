<?php

namespace App\Http\Requests\User;


use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class StoreUser extends Request
{
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
                'bail', 'required','string',
            ],
            'email' => [
                'bail','required', 'string','email',
                Rule::unique(User::class,'email'),
            ],
            'image' => [ 'bail','required','image','mimes:jpg,png' ],
            'pass' => [ 'bail','required', 'string', 'min:6' ],
            'phone' => [ 'bail','required', 'regex:/^([0-9\s\-\+\(\)]*)$/','max: 10','min:10'],
            'status' => [ 'required' ],
            'role' => [ 'required' ],
            'address' => [ 'required' ],
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => ' Họ và Tên ',
            'email' => 'Email',
            'image' => 'Avatar',
            'pass' => 'Mật Khẩu ',
            'phone' => 'Số điện thoại ',
            'address' => 'Địa chỉ ',
            'status' => 'Trạng thái ',
            'role' => ' Role ',
        ];
    }
}
