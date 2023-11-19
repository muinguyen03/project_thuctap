<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        $product = Product::find($this->id_product);
        $product_images = Storage::url(ProductImage::where('product_id', $product->id)->first()->image);
        return [
            'id_item'    => $this->id_item,
            'product'    => [
                'name'   => $product->name,
                'image'  => $product_images,
                'price'  => $product->price,
            ],
            'quantity'   => $this->quantity,
            'options'    => $this->options,
        ];
    }
}
