<?php

namespace App\Http\Requests\Client\Profile;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends Request
{
    public function rules()
    {
        return [
            'old_password'          => [ 'bail', 'required', 'string', 'min:3' ],
            'new_password'          => [ 'bail', 'required', 'string', 'min:3' ],
            'password_confirmation' => [ 'bail', 'required', 'string', 'min:3', 'same:new_password' ],
        ];
    }
    public function attributes(): array
    {
        return [
            'old_password'          => 'Mật khẩu cũ',
            'new_password'          => 'Mật khẩu mới',
            'password_confirmation' => 'Nhập lại mật khẩu mới'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->checkOldPassword()) {
                $validator->errors()->add('old_password', 'Mật khẩu cũ không chính xác');
            }
        });
    }

    protected function checkOldPassword()
    {
        return Hash::check($this->old_password, Auth::user()->password);
    }
}
