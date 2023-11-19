<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    protected string $column_id = '_id';


    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'exists'    => ':attribute không tồn tại !',
            'required'  => ':attribute bắt buộc phải điền !',
            'string'    => ':attribute phải là chuỗi !',
            'integer'   => ':attribute phải là số nguyên !',
            'unique'    => ':attribute đã được dùng !',
            'min'       => ':attribute phải có ít nhất :min ký tự !',
            'max'       => ':attribute không được vượt quá :max ký tự !',
            'array'     => ':attribute phải là mảng !',
            'in'        => ':attribute không thuộc danh sách giá trị hợp lệ !',
            'mime'      => ':attribute định dạng không hợp lệ !',
            'same'      => ':attribute không trùng khớp !',
            'size'      => ':attribute phải có kích thước nhỏ hơn :size !',
            'image'     => 'File không phải là ảnh !',
            'regex'     => ':attribute không đúng định dạng ! ',
            'lte'       => ':attribute không vượt quá 100% ! '
        ];
    }

}
