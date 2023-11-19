<?php

function VNPAY($order_code, $cost, $bank_code): string
{
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_Url        = env('VNP_URL');
        $vnp_BankCode   = $bank_code;

        $inputData = array (
            "vnp_Version"       => "2.1.0",
            "vnp_TmnCode"       => env('VNP_TMN_CODE'),
            "vnp_Amount"        => $cost * 100,
            "vnp_Command"       => "pay",
            "vnp_CreateDate"    => date('YmdHis'),
            "vnp_CurrCode"      => "VND",
            "vnp_IpAddr"        => request()->ip(),
            "vnp_Locale"        => 'vn',
            "vnp_OrderInfo"     => 'Thanh toán hóa đơn mua hàng',
            "vnp_OrderType"     => 'billpayment',
            "vnp_ReturnUrl"     => env('VNP_RETURN_URL'),
            "vnp_TxnRef"        => $order_code
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
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

        $vnp_Url = $vnp_Url . "?" . $query;
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return $vnp_Url;
    }

function PAYPAL(){

}
function MOMO($order_code, $cost){
    function execPostRequest($url, $data): bool|string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        return $result;
    }

    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    $partnerCode    = 'MOMOBKUN20180529';
    $accessKey      = 'klm05TvNBzhg7h7j';
    $secretKey      = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    $orderInfo      = "Thanh toán qua ATM MoMo";
    $amount         = $cost;
    $redirectUrl    = env('URL_PAYMENT_STATUS');
    $ipnUrl         = env('URL_PAYMENT_STATUS');
    $extraData      = "";
    $orderId        = $order_code;

    $requestId = time() . "";
    $requestType = "payWithATM";

    $rawHash =
        "accessKey=" . $accessKey .
        "&amount=" . $amount .
        "&extraData=" . $extraData .
        "&ipnUrl=" . $ipnUrl .
        "&orderId=" . $orderId .
        "&orderInfo=" . $orderInfo .
        "&partnerCode=" . $partnerCode .
        "&redirectUrl=" . $redirectUrl .
        "&requestId=" . $requestId.
        "&requestType=" . $requestType;

    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    $data = array(
        'partnerCode'   => $partnerCode,
        'partnerName'   => "Test",
        "storeId"       => "MomoTestStore",
        'requestId'     => $requestId,
        'amount'        => $amount,
        'orderId'       => $orderId,
        'orderInfo'     => $orderInfo,
        'redirectUrl'   => $redirectUrl,
        'ipnUrl'        => $ipnUrl,
        'lang'          => 'vi',
        'extraData'     => $extraData,
        'requestType'   => $requestType,
        'signature'     => $signature
    );

    $result = execPostRequest($endpoint, json_encode($data));
    return json_decode($result, true);

}

function ONEPAY(){

}


