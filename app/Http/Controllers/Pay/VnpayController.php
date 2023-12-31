<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;

class VnpayController extends Controller
{
    private mixed $vnp_TmnCode;
    private mixed $vnp_HashSecret;
    private mixed $vnp_Url;
    private mixed $vnp_Returnurl;
    private Carbon $vnp_TxnRef;
    private string $vnp_OrderInfo;
    private string $vnp_OrderType;
    private string $vnp_Locale;
    private string $vnp_BankCode;
    private mixed $vnp_IpAddr;
    private string $vnp_Bill_State;
    private Order $order;
    public function __construct()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->vnp_TmnCode    = env("VNPAY_TMN_CODE");
        $this->vnp_HashSecret = env("VNPAY_HASH_SECRET");
        $this->vnp_Url        = env("VNPAY_URL");
        $this->vnp_Returnurl  = env("VNPAY_RETURN_URL");
//        $this->vnp_TxnRef     = now();
        $this->vnp_OrderInfo  = 'Thanh toán hóa đơn';
        $this->vnp_OrderType  = 'billpayment';
        $this->vnp_Locale     = 'vn';
        $this->vnp_BankCode   = '';
        $this->vnp_Bill_State   = '';
        $this->vnp_IpAddr     = $_SERVER['REMOTE_ADDR'];
        $this->order = new Order();
    }
    public function process($order_code,$amount)
    {
        $inputData = array(
            "vnp_Version"       => "2.1.0",
            "vnp_TmnCode"       => $this->vnp_TmnCode,
            "vnp_Amount"        => (integer)$amount * 100,
            "vnp_Command"       => "pay",
            "vnp_CreateDate"    => date('YmdHis'),
            "vnp_CurrCode"      => "VND",
            "vnp_IpAddr"        => $this->vnp_IpAddr,
            "vnp_Locale"        => $this->vnp_Locale,
            "vnp_OrderInfo"     => $this->vnp_OrderInfo,
            "vnp_OrderType"     => $this->vnp_OrderType,
            "vnp_ReturnUrl"     => $this->vnp_Returnurl,
            "vnp_TxnRef"        => $order_code,
        );
        if (isset($this->vnp_BankCode) && $this->vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $this->vnp_BankCode;
        }
        if (isset($this->vnp_Bill_State) && $this->vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $this->vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $this->vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $this->vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        return redirect($vnp_Url);
    }
    public function status(Request $request)
    {
        $data = [
            'vnp_Amount'            => $request->vnp_Amount,
            'vnp_BankCode'          => $request->vnp_BankCode,
            'vnp_CardType'          => $request->vnp_CardType,
            'vnp_OrderInfo'         => $request->vnp_OrderInfo,
            'vnp_PayDate'           => $request->vnp_PayDate,
            'vnp_TransactionStatus' => $request->vnp_TransactionStatus,
        ];
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $object = $this->order->where('order_code', (integer)$request->vnp_TxnRef)->first();
                $object['status_payment'] = 1;
                $object->save();
                Telegram::sendMessage([
                    'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                    'parse_mode' => 'HTML',
                    'text' => 'Invoice: '.(integer)$request->vnp_TxnRef .' has been paid successfully'
                ]);
            }
            else {
                $object = $this->order->where('order_code', (integer)$request->vnp_TxnRef)->first();
                $object['status_payment'] = 2;
                $object['tracking'] = 5;
                $object->save();
                Telegram::sendMessage([
                    'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                    'parse_mode' => 'HTML',
                    'text' => 'Invoice: '.(integer)$request->vnp_TxnRef .' has been canceled payment'
                ]);
            }
        } else {
            $object = $this->order->where('order_code', (integer)$request->vnp_TxnRef)->first();
            $object['status_payment'] = 3;
            $object['tracking'] = 5;
            $object->save();
            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                'parse_mode' => 'HTML',
                'text' => 'Invoice: '.(integer)$request->vnp_TxnRef .' has been paid failed. Code error: '.$_GET['vnp_ResponseCode']
            ]);
        }
        return redirect()->route('client.order.status',(integer)$request->vnp_TxnRef);
    }
}
