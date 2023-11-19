<?php

namespace App\Http\Requests\Client\Profile;

use App\Http\Requests\Request;

class UpdateImageRequest extends Request
{
    public function rules()
    {
        return [
            'image_user' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5042 ' ],
        ];
    }
    public function attributes()
    {
        return [
          'image_user' => 'Ảnh'
        ];
    }
}
