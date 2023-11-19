<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Notifications\OrderSuccess;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Laravel\Facades\Telegram;

class OrderController extends Controller
{
    private Order $order;
    private OrderDetail $order_detail;
    private Cart $cart;

    public function __construct()
    {
        $this->order = new Order();
        $this->order_detail = new OrderDetail();
        $this->cart = new Cart();
    }
    public function process(Request $request): JsonResponse
    {
        $input = $request->all()['data'];
        $currentDateTime = Carbon::now();
        $order_code = $currentDateTime->timestamp;
        $formattedDateTime = $currentDateTime->format('d/m/Y H:i:s');
        $payment_method = $input['payment_method'];
        $order = [
            'user_id'           => Auth::user()->id,
            'order_code'        => $order_code,
            'order_date'        => $formattedDateTime,
            'payment_method'    => $payment_method,
            'total'             => $input['total'],
            'subtotal'          => $input['subtotal'],
            'ship'              => $input['ship'],
            'user'              => $input['customer'],
            'note'              => $input['note'],
            'promotion'         => $input['discount'],
            'carriers'          => null
        ];
        $this->order->create($order);
        foreach ($input['items'] as $item)
        {
            $order_detail = [
                'order_code' => $order_code,
                'product'    => $item['product'],
                'options'    => $item['options'],
                'quantity'   => $item['quantity'],
            ];
            $this->order_detail->create($order_detail);
        }
        $this->cart->where('id_user', Auth::user()->id)->delete();

        $message =
            "Invoice         |   ".$order_code."\n".
            "Order Date   |   ".$formattedDateTime."\n".
            "Total             |   ".number_format($input['total'], 0, '', ',')." VNĐ\n"
        ;
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'HTML',
            'text' => $message
        ]);
        $info = [
            'order_code'  => $order_code,
            'order_date'  => $formattedDateTime,
            'payment'     => $payment_method == 0 ? 'Cash on delivery' : ($payment_method == 1 ? 'VietQR' : 'VNPAY'),
            'total'       => number_format($input['total'], 0, '', ',')." VNĐ",
        ];
        $user = User::where('email', Auth::user()->email)->firstOrFail();
        $user->notify(new OrderSuccess($user->name, $info, route('client.order.detail',$order_code)));
        if($payment_method == 0){
            return response()->json(['url' => route('client.order.status',$order_code)]);
        }
        else if($payment_method == 1){
            return response()->json(['url' => route('client.order.status',$order_code)]);
        }
        else if($payment_method == 2){
            return response()->json(['url' => url('/pay/vnpay/'.$order_code.'/'.$input['total']),]);
        }
        else {
            return response()->json(['message' => 'error'], 500);
        }
    }
    public function updateTracking(Request $request, $order_code){
        $order = $this->order->where('order_code', (integer)$order_code)->first();
        $order->tracking = (integer)$request->tracking;
        $order->save();
        return redirect()->route('client.order.detail',$order_code);
    }
    public function detail($order_code){
        $order = $this->order
            ->where('user_id', Auth::user()->id)
            ->where('order_code', (integer)$order_code)
            ->first();
        if(!$order){
            return response()->json([
                'message' => 'error',
                'data' => 'Order not found'
            ], 404);
        }
        else {
            $order_detail = $this->order_detail
                ->where('order_code', (integer)$order->order_code)
                ->get();
            $values = [
                'order' => $order,
                'order_detail' => $order_detail,
            ];
            return view('client.order.detail',compact('values'));
        }
    }
    public function status($order_code){
        $order = $this->order
            ->where('user_id', Auth::user()->id)
            ->where('order_code', (integer)$order_code)
            ->first();
        if(!$order){
            return response()->json([
                'message' => 'error',
                'data' => 'Order not found'
            ], 404);
        }
        else {
            $order_detail = $this->order_detail
                ->where('order_code', (integer)$order->order_code)
                ->get();
            $values = [
                'order' => $order,
                'order_detail' => $order_detail,
            ];
            return view('client.order.status',compact('values'));
        }
    }
}


