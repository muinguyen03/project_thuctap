<?php

namespace App\Http\Resources;

use App\Models\OrderDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray($request)
    {
        $detail = OrderDetail::find('order_code',$this->order_code);
        return [
            'order_code'    => $this->order_code,
            'order_date'    => $this->order_date,
            'payment_method'    => $this->payment_method,
            'total'    => $this->total,
            'user' => $this->user,
            'note' => $this->note,
            'promotion' => $this->promotion,
            'detail' => $detail,
        ];
    }
}
