<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductStatusEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FindProduct;
use App\Http\Requests\Product\StoreProduct;
use App\Http\Requests\Product\UpdateProduct;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    private Product $product;
    private ProductImage $product_image;
    private Category $cate;
    public function __construct()
    {
        $this->product  = new Product();
        $this->cate     = new Category();
        $this->product_image = new ProductImage();
        $arrStatus = StatusEnum::getStatus();
        View::share('arrStatus', $arrStatus);
        View::share('countList', count($this->product->all()));
        View::share('countTrash', count($this->product->onlyTrashed()->get()));
        View::share('arrSize', ['XS', 'S', 'M', 'L', 'XL', 'XXL']);
    }
    public function index(Request $request): Factory|\Illuminate\Contracts\View\View|Application
    {
        $query = $this->product->newQuery();
        if ($request->has('q')) {
            $searchTerm = $request->input('q');
            $query->where('name_product', 'LIKE', '%' . $searchTerm . '%');
        }
        $products = $query->paginate(3);
        return view('admin.module.products.index',compact('products'));
    }
    public function trash(Request $request): Factory|\Illuminate\Contracts\View\View|Application
    {
        $query = $this->product->newQuery();
        if ($request->has('q')) {
            if($request->input('q') != ''){
                $searchTerm = $request->input('q');
                $query->where('name_category', 'LIKE', '%' . $searchTerm . '%');
            }
        }
        $products = $query->onlyTrashed()->paginate(5);
        return view('admin.module.products.trash',compact('products'));
    }

    public function restore($id_item_trash): RedirectResponse
    {
        $product = $this->product->withTrashed()->where('_id', $id_item_trash);
        if(!$product){
            return redirect()->route('product.trash')->with('error','Product not found');
        }
        $product->restore();
        return redirect()->route('product.index')->with('success','Restore Product Successfully !');
    }

    public function force($id_item_trash): RedirectResponse
    {
        $product = $this->product->withTrashed()->where('_id', $id_item_trash);
        if(!$product){
            return redirect()->route('product.trash')->with('error','Product not found');
        }
        Storage::disk('public')->deleteDirectory('products/'.$id_item_trash);
        $product->forceDelete();
        Cart::where('id_product', $id_item_trash)->delete();
        return redirect()->route('product.trash')->with('success','Delete Successfully !');
    }
    public function create()
    {
        if(count( $this->cate->all()) == 0){
            return redirect()->route('category.create')->with('error','Please create category first !');
        }
        else {
            $cate = $this->cate->where('status', 0)->get();
            return view('admin.module.products.create')->with('categories', $cate);
        }
    }
    public function store(StoreProduct $request): RedirectResponse
    {
        $arr    = $request->all();

        $colors = explode('|', $request->color);
        $arr['color'] = $colors;

        $this->product->create($arr);

        $product = $this->product->where('name', $request->name)->first();
        $images = $request->file('images');
        if ($images) {
            $uploadedFileUrl = $this->UploadMultiImage($images,'products/'.$product->id.'/');
            foreach ($uploadedFileUrl as $key => $image) {
                $this->product_image->create([
                    'product_id' => $product->id,
                    'image' => $image,
                    'serial' => $key+1,
                ]);
            }
        }

        return redirect()->route('product.index')->with('success','Create Successfully !');
    }
    public function edit(FindProduct $request, $product)
    {
        $object = $this->product->find($product);
        if(!$object){
            return redirect()->route('product.index')->with('error','Product not found');
        }
        $images = $this->product_image->where('product_id', $product)->get();
        $cate = $this->cate->where('status', 0)->get();
        return view('admin.module.products.edit',[
            'product'    => $object,
            'categories' => $cate,
            'images'     => $images,
        ]);
    }
    public function update(UpdateProduct $request, $productId): RedirectResponse
    {
        $object = $this->product->find($productId);
        if(!$object){
            return redirect()->route('product.index')->with('error','Product not found');
        }
        $productImages = $this->product_image->where('product_id', $object->id)->get();
        foreach ($productImages as $item) {
            $image = $request->file($item->id);
            if ($image) {
                Storage::disk('public')->delete($item->image);
                $uploadedFileUrl = $this->UploadImage($image, 'products/'.$object->id.'/');
                $item->update([
                    'image' => $uploadedFileUrl,
                ]);
            }
        }

        $arr = $request->input();
        $colors = explode('|', $request->color);
        $arr['color'] = $colors;
        $arr['status'] = (integer)$request->status;

        $object->update($arr);

        return redirect()->route('product.index')->with('success','Update Product Successfully !');
    }
    public function destroy(FindProduct $request, $productId): RedirectResponse
    {
        $product = $this->product->find($productId);
        if(!$product){
            return redirect()->route('product.index')->with('error','Product not found');
        }
        $this->product->destroy($productId);
        return redirect()->route('product.index')->with('success','Delete Product Successfully !');
    }
    public function deleteAll(){
        $this->product
            ->where('deleted_at', '!=', null)
            ->forceDelete();
        return redirect()->route('product.trash')->with('success','Delete All Product Successfully !');
    }
}
