<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Eloquent
{
    use Authenticatable, HasFactory, Notifiable;
    protected $connection = 'mongodb';
    protected $fillable = [
        'product_id',
        'user',
        'star',
        'content',
        'status',
        'user_id'
    ];
    protected $attributes = [
        'status'  => 0,
    ];
}
