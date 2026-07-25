<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($limit = 10)
    {
        $list = Order::with('customer')
            ->orderBy('id', 'desc')
            ->paginate($limit);

        return view('admin.orders.index', compact('list'));
    }

    public function show(string $id)
    {
        $order = Order::with(['customer', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3,4',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
