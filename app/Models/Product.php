<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
class Product extends Eloquent
{
    use Authenticatable, HasFactory, Notifiable,SoftDeletes;
    protected $connection = 'mongodb';
    public $timestamps = false;
    protected $fillable = [
        'status',
        'name',
        'price',
        'category_id',
        'image',
        'author',
        'description',
        'description_sort',
        'deleted_at'


    ];
    protected $attributes = [
        'status'  => 0,
        'description' => '',
        'description_sort' => '',
        'category_id' => '64ba54a608a04b6e800859a2',
        'deleted_at' => null

    ];
    public function getMoneyFormatAttribute(): string
    {
        return number_format($this->price, 0, '', ',')." VNĐ";
    }
    public function getCategoryProductAttribute(): string
    {
        return Category::find($this->category_id)->name_category;
    }

    public function getImgAttribute(): string
    {
        return Storage::url(ProductImage::where('product_id', $this->id)->first()->image);
    }

    public function checkRateExistAttribute(){
        return Rate::where('user_id',Auth::user()->id)->where('product_id',$this->id)->exists();
    }

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
