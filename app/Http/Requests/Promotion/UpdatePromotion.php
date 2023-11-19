<?php

namespace App\Http\Requests\Promotion;

use App\Http\Requests\Request;
use App\Models\Promotion;
use Illuminate\Validation\Rule;

class UpdatePromotion extends Request
{
    public function prepareForValidation():void{
        $this->merge(['promotion' => $this->route('promotion')]);
    }
    public function rules(): array
    {
        return [
            'code' => [
                'bail', 'required','string',
                Rule::unique(Promotion::class)->ignore($this->promotion, $this->column_id),
            ],
            'exp' => ['required','date'],
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
