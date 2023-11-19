<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Rate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    private Product $product;
//    private Banner $banner;
    private Category $category;
    private Order $order;
    private Rate $rate;
    private int $status;
    private Banner $banner;
    private ProductImage $product_image;

    public function __construct(){
        $this->category = new Category();
        $this->product  = new Product();
        $this->product_image = new ProductImage();
        $this->banner   = new Banner();
        $this->status   = 0;
        $this->order = new Order();
        $this->rate = new Rate();

    }
    public function home(): Factory|View|Application
    {
        $products = $this->product->where('status', $this->status)->limit(8)->get();
        $banners = $this->banner->where('status',0)->get();
        return view('client.home',compact('products','banners'));
    }
    public function shop()
    {
        $products = $this->product->where('status',$this->status)->paginate(4);
        $categories = $this->category->all();
        return view('client.shop',compact('products','categories'));
    }
    public function about(): Factory|View|Application
    {
        return view('client.about');
    }
    public function contact(): Factory|View|Application
    {
        return view('client.contact');
    }
    public function cart(): Factory|View|Application
    {
        return view('client.cart');
    }
    public function checkout(): Factory|View|Application
    {
        return view('client.checkout');
    }
    public function product_detail($productId): Factory|View|Application|RedirectResponse
    {
        $product_detail = $this->product->find($productId);
        $product_images = $this->product_image->where('product_id',$productId)->get();
        $rate = $this->rate->where('product_id', $productId)->get();
        $product_related = $this->product->where('category_id', $product_detail->category_id)->where('_id','!=',$productId)->limit(8)->get();
        if($product_detail->status == 1){
            return redirect()->route('client.shop')->with('error','Sản phẩm đã ngừng kinh doanh');
        }
        return view('client.product-detail',compact(
            'product_images',
            'product_detail',
            'rate',
            'product_related'
        ));
    }
    public function search(Request $request): View|Factory|Application|RedirectResponse
    {
        if($request->q){
            $key = $request->q;

            $categories = $this->category->all();
            $query = $this->product->newQuery();

            if ($request->has('q')) {
                $query->where('name', 'LIKE', '%' . $key . '%');
            }
            $products = $query->where('status',$this->status)->paginate(4);
            return view('client.search',compact('products','categories','key'));

        }else {
            return redirect()->route('client.home');
        }
    }

    public function profile(): Factory|View|Application
    {
        $order = $this->order->where('user_id', Auth::user()->id)->get();
        return view('client.profile',compact('order'));
    }


}
