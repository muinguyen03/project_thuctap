<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mongodb';
    protected $fillable = [
        'user_id',
        'order_code',
        'order_date',
        'payment_method',
        'total',
        'user',
        'note',
        'promotion',
        'tracking',
        'status_payment',
        'ship',
        'subtotal',
        'carriers'
    ];
    protected $attributes = [
        'tracking'        => 0,
        'status_payment'  => 0,
    ];
    protected $hidden = [
        'user_id', '_id'
    ];
    public function getMoneyFormatAttribute(): string
    {
        return number_format($this->total, 0, '', ',')." VNĐ";
    }
    public function getDiscountFormatAttribute(): string
    {
        return $this->promotion['discount']." %";
    }
    public function getShippingFormatAttribute(): string
    {
        return number_format($this->ship, 0, '', ',')." VNĐ";
    }
    public function getSubtotalFormatAttribute(): string
    {
        return number_format($this->subtotal, 0, '', ',')." VNĐ";
    }
    public function getTotalFormatAttribute(): string
    {
        return number_format($this->total, 0, '', ',')." VNĐ";
    }

}
