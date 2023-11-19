<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Eloquent
{
    use Authenticatable, HasFactory, Notifiable;
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'image',
    ];
    protected $attributes = [
        'status' => 0,
    ];
    public function getImgProductAttribute(): string
    {
        return Storage::url($this->image);
    }
}
