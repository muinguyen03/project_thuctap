<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\StoreCart;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{

    private Cart $model;

    public function __construct()
    {
        $this->model = new Cart();
    }

    public function index(): JsonResponse
    {
        $cart = $this->model->where('id_user', Auth::user()->id)->get();
        $resource = CartResource::collection($cart);
        return response()->json($resource);
    }
    public function store(StoreCart $request){
        $user_id = Auth::user()->id;
        $exitsItem =
            $this->model
                ->where('id_product', $request->id_product)
                ->where('id_user', $user_id)
                ->where('options', $request->options)
                ->first();
        $product = Product::find($request->id_product);
        $product_image = Storage::url(ProductImage::where('product_id', $product->id)->first()->image);
        if($exitsItem){
            $exitsItem->quantity += $request->quantity;
            $exitsItem->save();
            $return = [
                'id_item' => $exitsItem->id_item,
                'product' => [
                    'name'  => $product->name,
                    'image' => $product_image,
                    'price' => $product->price,
                ],
                'quantity' => $exitsItem->quantity,
                'options'  => $exitsItem->options,
            ];
        }
        else {
            $id_item = random_int(1, 99);
            $data = [
                'id_product' => $request->id_product,
                'id_user'    => Auth::user()->id,
                'quantity'   => $request->quantity,
                'options'    => $request->options,
                'id_item'    => $id_item,
            ];
            $this->model->create($data);
            $return = [
                'id_item' => $id_item,
                'product' => [
                    'name'  => $product->name,
                    'image' => $product_image,
                    'price' => $product->price,
                ],
                'quantity' => $request->quantity,
                'options'  => $request->options,
            ];
        }
        return response()->json($return);
    }
    public function update(Request $request, $cartItemId){
        $item = $this->model->where('id_user', Auth::user()->id)
            ->where('id_item', (integer)$cartItemId)
            ->update(['quantity' => $request->quantity]);
        if($item == 1){
            return response()->json(['message' => 'Cập nhật giỏ hàng thành công'], 200);
        }
        else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 404);
        }
    }
    public function remove(Request $request, $cartItemId){
        $item = $this->model->where('id_user', Auth::user()->id)
            ->where('id_item', (integer)$cartItemId)
            ->delete();
        if($item == 1){
            return response()->json(['message' => 'Xóa sản phẩm thành công'], 200);
        }
        else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 404);
        }
    }
    public function destroy(){
        $this->model->where('id_user', Auth::user()->id)->delete();
        return response()->json(['message' => 'Xóa giỏ hàng thành công'], 200);
    }
}
