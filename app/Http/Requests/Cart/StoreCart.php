<?php

namespace App\Http\Requests\Cart;

use App\Http\Requests\Request;
use App\Models\Product;
use Illuminate\Validation\Rule;

class StoreCart extends Request
{
    public function rules(): array
    {
        return [
            'id_product' => ['bail', 'required', 'string', Rule::exists(Product::class, $this->column_id)],
            'quantity'   => ['bail', 'required', 'integer', 'min:1'],
            'options'    => ['array'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_product' => 'Sản phẩm',
            'quantity'   => 'Số lượng',
        ];
    }
}
