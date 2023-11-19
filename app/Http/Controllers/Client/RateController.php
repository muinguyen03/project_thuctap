<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    private Rate $rate;

    public function __construct()
    {
        $this->rate = new Rate();

    }
    public function index($productId){
        $rates = $this->rate->where('product_id',$productId)->get();
        return response()->json($rates);
    }
    public function store(Request $request){
        $value = [
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
            'user' => [
                'name'=> Auth::user()->name,
                'image' => Auth::user()->image,
            ],
            'star' => (integer)$request->rating,
            'content' => $request->review,
        ];
        $this->rate->create($value);
        return redirect()->route('client.product_detail',$request->product_id.'?tab=reviews' );
    }
}
