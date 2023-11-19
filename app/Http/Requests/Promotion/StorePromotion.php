<?php

namespace App\Http\Requests\Promotion;

use App\Http\Requests\Request;
use App\Models\Promotion;
use Illuminate\Validation\Rule;

class StorePromotion extends Request
{

    public function rules(): array
    {
        return [
            'code' => [
                'bail', 'required','string',
                Rule::unique(Promotion::class, 'code'),
            ],
            'exp' => ['required','date','after:today'],
            'discount' => ['bail', 'required', 'integer','numeric','lte:100'],
            'status' => [ 'required' ],
        ];
    }

    public function attributes(): array
    {
        return [
            'code' => 'Code',
            'exp' => 'Exprid',
            'discount' => 'Discount',
            'status' => 'Status',
        ];
    }


}
