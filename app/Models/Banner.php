<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Banner extends Eloquent
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'url',
        'status',
        'deleted_at'
    ];
    protected $attributes = [
        'status'  => 1,
        'deleted_at' => null
    ];
    public function getImageBannerAttribute(): string
    {
        return Storage::url($this->url);
    }
}
