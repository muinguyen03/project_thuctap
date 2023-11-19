<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mongodb';
    protected $fillable = [
        'order_code',
        'product',
        'options',
        'quantity',
    ];
    protected $hidden = [
        '_id', 'order_code'
    ];

    public function getOrderDetailMoneyItemFormatAttribute(): string
    {
        return number_format($this->product['price'], 0, '', ',')." VNĐ";
    }
    public function getOrderDetailMoneyTotalItemFormatAttribute(): string
    {
        return number_format(($this->product['price'] * $this->quantity), 0, '', ',')." VNĐ";
    }
}
