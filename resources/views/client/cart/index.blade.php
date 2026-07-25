@extends('client.layouts.app')

@section('title', 'Giỏ hàng của bạn')

@section('content')
<h2 class="mb-4 fw-bold"><i class="bi bi-cart3 me-2"></i>Giỏ hàng của bạn</h2>

@if (empty($cart))
    <div class="p-5 text-center bg-white rounded shadow-sm">
        <i class="bi bi-cart-x fs-1 text-muted"></i>
        <h4 class="mt-3 text-muted">Giỏ hàng của bạn đang trống!</h4>
        <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Tiếp tục mua sắm</a>
    </div>
@else
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalMoney = 0; @endphp
                            @foreach ($cart as $id => $item)
                                @php
                                    $subTotal = $item['price'] * $item['quantity'];
                                    $totalMoney += $subTotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $item['image'] ? asset('storage/products/' . $item['image']) : 'https://via.placeholder.com/60' }}" 
                                                 alt="{{ $item['proname'] }}" 
                                                 class="rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                            <div>
                                                <h6 class="mb-0 text-truncate" style="max-width: 200px;">{{ $item['proname'] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ number_format($item['price'], 0, ',', '.') }} đ</td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center gap-1" style="max-width: 130px;">
                                            @csrf
                                            <input type="hidden" name="productid" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm text-center">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary" title="Cập nhật">
                                                <i class="bi bi-arrow-clockwise"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="fw-bold text-danger">{{ number_format($subTotal, 0, ',', '.') }} đ</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="productid" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 p-3">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Tóm tắt đơn hàng</h5>
                <div class="d-flex justify-content-between mb-3 fs-5">
                    <span>Tổng tiền:</span>
                    <span class="fw-bold text-danger">{{ number_format($totalMoney, 0, ',', '.') }} đ</span>
                </div>
                <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg w-100 mb-2">
                    <i class="bi bi-credit-card me-2"></i>Tiến hành Đặt hàng
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i>Tiếp tục mua hàng
                </a>
            </div>
        </div>
    </div>
@endif
@endsection
