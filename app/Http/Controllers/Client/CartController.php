<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * 1. Lấy giỏ hàng từ session (nếu chưa tồn tại tạo giỏ hàng rỗng)
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('client.cart.index', compact('cart'));
    }

    /**
     * 2 & 3 & 4. Thêm sản phẩm vào giỏ hàng & Lưu giỏ hàng vào session
     */
    public function add(Request $request)
    {
        $request->validate([
            'productid' => 'required|exists:products,id',
            'quantity'  => 'required|integer|min:1',
        ]);

        $id = $request->input('productid');
        $quantity = (int) $request->input('quantity', 1);

        // $product : lấy từ DB
        $product = Product::findOrFail($id);
        $finalPrice = ($product->pricediscount > 0 && $product->pricediscount < $product->price) 
            ? $product->pricediscount 
            : $product->price;

        // Lấy giỏ hàng hiện tại từ Session
        $cart = Session::get('cart', []);

        // 4. Kiểm tra sản phẩm nếu đã tồn tại trong giỏ hàng cập nhật lại số lượng
        if (isset($cart[$id])) {
            // nếu tồn tại rồi - tăng số lượng
            $cart[$id]['quantity'] += $quantity;
        } else {
            // 2. Thêm sản phẩm vào giỏ hàng
            $cart[$id] = [
                'productid' => $product->id,
                'proname'   => $product->productname,
                'image'     => $product->image,
                'quantity'  => $quantity,
                'price'     => $finalPrice,
            ];
        }

        // 3. Lưu giỏ hàng vào session
        Session::put('cart', $cart);

        return back()->with('success', 'Thêm vào giỏ hàng thành công!');
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng
     */
    public function update(Request $request)
    {
        $request->validate([
            'productid' => 'required',
            'quantity'  => 'required|integer|min:1',
        ]);

        $id = $request->input('productid');
        $quantity = (int) $request->input('quantity');

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            Session::put('cart', $cart);
            return back()->with('success', 'Cập nhật số lượng thành công!');
        }

        return back()->with('error', 'Sản phẩm không có trong giỏ hàng.');
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng
     */
    public function remove(Request $request)
    {
        $id = $request->input('productid');
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
            return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
        }

        return back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }

    /**
     * Trang Đặt hàng (Checkout)
     */
    public function checkout()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        return view('client.cart.checkout', compact('cart'));
    }

    /**
     * 5. Xóa giỏ hàng trong session sau khi đặt hàng thành công: Session::forget('cart');
     */
    public function postCheckout(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'email'   => 'nullable|email|max:100',
            'address' => 'required|string|max:255',
            'note'    => 'nullable|string',
        ], [
            'name.required'    => 'Vui lòng nhập họ và tên',
            'phone.required'   => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập địa chỉ giao hàng',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Tính tổng tiền đơn hàng
        $totalMoney = 0;
        foreach ($cart as $item) {
            $totalMoney += $item['price'] * $item['quantity'];
        }

        // 1. Tạo Khách hàng
        $customer = Customer::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'address' => $request->address,
        ]);

        // 2. Tạo Đơn hàng
        $order = Order::create([
            'customer_id' => $customer->id,
            'total_money' => $totalMoney,
            'note'        => $request->note,
            'status'      => 0, // 0: Mới đặt
        ]);

        // 3. Tạo các Chi tiết đơn hàng
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item['productid'],
                'product_name' => $item['proname'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
            ]);
        }

        // 5. Xóa giỏ hàng trong session
        Session::forget('cart');

        return redirect()->route('home')->with('success', 'Đặt hàng thành công! Mã đơn hàng của bạn là #' . $order->id);
    }
}
