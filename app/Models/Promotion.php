<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Promotion extends Eloquent
{
    use Authenticatable, HasFactory, Notifiable,SoftDeletes;
    public $timestamps = false;
    protected $connection = 'mongodb';
    protected $fillable = [
        'code',
        'exp',
        'discount',
        'status',
        'deleted_at'

    ];
    protected $attributes = [
        'status' => "0",
        'deleted_at' => null

    ];

    public function getDiscountFormatAttribute(): string
    {
        return $this->discount." %";
    }
}
