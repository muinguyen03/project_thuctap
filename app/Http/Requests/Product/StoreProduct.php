<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;

class StoreProduct extends Request
{
    public function rules(): array
    {
        return [
            'name'  => [
                'bail', 'required', 'string',
                Rule::unique(Product::class,'name'),
            ],
            'price' => [
                'bail', 'required', 'integer'
            ],
            'category_id' => [
                Rule::exists(Category::class, $this->column_id),
            ],
//            'images'     => [ 'required','array','mimes:jpeg,png,jpg,gif'],
            'images'     => 'required|array',
            'images.*'   => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'name'          => 'Name',
            'price'         => 'Price',
            'image'         => 'Image',
            'category_id'   => 'Category',
        ];
    }

}
