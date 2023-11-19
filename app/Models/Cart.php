<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Cart extends Eloquent
{
    use HasFactory;
    protected $connection= 'mongodb';
    protected $fillable =[
        'id_product',
        'id_user',
        'quantity',
        'options',
        'id_item'
    ];
}
