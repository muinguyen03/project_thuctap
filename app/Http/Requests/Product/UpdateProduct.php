<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductStatusEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;

class UpdateProduct extends Request
{
    protected function prepareForValidation(): void
    {
        $this->merge(['product' => $this->route('product')]);
    }

    public function rules(): array
    {
        if (!Product::find($this->product)) {
            return [
                'product' =>[
                    'bail', 'required',
                    Rule::exists(Product::class, $this->column_id)
                ]
            ];
        }

        return [
            'name' => [
                'bail','required','string',
                Rule::unique(Product::class, $this->column_id)->ignore($this->product),
            ],
            'price' => [
                'bail','required','integer',
            ],
            'category_id' => [
                Rule::exists(Category::class, $this->column_id),
            ],
            'status' => [
                'bail','required','integer',
                Rule::in(StatusEnum::asArray()),
            ],
            'image'      => [ 'mimes:jpg,png' ],
            'dimensions' => [ 'required' ],
            'materials'  => [ 'required' ],
            'weight'     => [ 'required' ],
            'size'       => [ 'required', 'array' ],
            'color'      => [ 'required', 'string' ],
        ];

    }

    public function attributes(): array
    {
        return [
            'product'   => 'San pham',
            'name'      => 'Ten san pham',
            'status'    => 'Trang thai',
        ];
    }

}
