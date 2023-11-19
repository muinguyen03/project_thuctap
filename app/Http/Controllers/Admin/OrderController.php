<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    private Order $order;
    private OrderDetail $order_detail;
    public function __construct()
    {
        $this->order = new Order();
        $this->order_detail = new OrderDetail();
    }
    public function index(): Factory|View|Application
    {
        $orders = $this->order->paginate(3);
        return view('admin.module.orders.index',compact('orders'));
    }
    public function store(Request $request): void
    {
        $this->order->create($request->carriers);
    }
    public function show($invoiceId): Factory|View|Application
    {
        $order = $this->order->where('order_code',(integer)$invoiceId)->first();
        $order_detail = $this->order_detail->where('order_code', (integer)$order->order_code)->get();
        return view('admin.module.orders.detail',compact('order','order_detail'));
    }
    public function update(Request $request, $invoiceID): RedirectResponse
    {
        $this->order->where('order_code', (integer)$invoiceID)->update(['tracking' => (integer)$request->trackingValue]);
        return redirect()->route('order.show', $invoiceID)->with('success','Cập nhật thành công');
    }
    public function updateCarries(Request $request, $invoiceID): RedirectResponse
    {
        $this->order->where('order_code', (integer)$invoiceID)->update([
            'carriers' => [
                'name' => $request->name,
                'billcode' => $request->billcode
            ]
        ]);
        return redirect()->route('order.show', $invoiceID)->with('success','Cập nhật thành công');
    }
    public function updatePayment(Request $request, $invoiceID): RedirectResponse
    {
        $this->order->where('order_code', (integer)$invoiceID)->update([
            'status_payment' => (integer)$request->status_payment
        ]);
        return redirect()->route('order.show', $invoiceID)->with('success','Cập nhật thành công');
    }
}
