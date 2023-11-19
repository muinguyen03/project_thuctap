<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;
use App\Models\Product;
use Illuminate\Validation\Rule;

class FindProduct extends Request
{

    public function rules(): array
    {
        return [
            'product' => [
                'bail','required',
                Rule::exists(Product::class, $this->column_id)
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['product' => $this->route('product')]);
    }

    public function attributes(): array
    {
        return ['product' => 'San pham'];
    }
}
