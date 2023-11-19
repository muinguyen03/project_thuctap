<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{


    private Promotion $promotion;

    public function __construct()
    {
        $this->promotion = new Promotion();

    }

    public function checkCode(Request $request): JsonResponse
    {
        $code = $request->code;
        $promotion = $this->promotion->where('code', $code)->where('status', "0")->first();
        if($promotion){
            if($promotion->exp < now()){
                return response()->json([
                    'status' => false,
                ]);
            }
            return response()->json([
                'status' => true,
                'discount'   => (int)$promotion->discount,
            ]);
        }
        else {
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
