@extends('admin.layouts.admin')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>CHI TIẾT ĐƠN HÀNG #{{ $order->id }}</h2>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i>Quay lại danh sách
    </a>
</div>

<x-admin.alert />

<div class="row">
    {{-- Thông tin khách hàng --}}
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white fw-bold">THÔNG TIN KHÁCH HÀNG</div>
            <div class="card-body">
                <p><strong>Họ và tên:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->customer->phone ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $order->customer->email ?? 'N/A' }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->customer->address ?? 'N/A' }}</p>
                <p><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
                <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>

        {{-- Cập nhật trạng thái --}}
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-header bg-primary text-white fw-bold">CẬP NHẬT TRẠNG THÁI</div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái đơn hàng:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>0. Mới đặt</option>
                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>1. Đã xác nhận</option>
                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>2. Đang giao hàng</option>
                            <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>3. Đã hoàn thành</option>
                            <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>4. Đã hủy</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Cập nhật trạng thái</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Danh sách sản phẩm trong đơn --}}
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white fw-bold">DANH SÁCH SẢN PHẨM ĐẶT HÀNG</div>
            <div class="card-body p-0">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="fw-bold">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold fs-5">TỔNG TỀN:</td>
                            <td class="fw-bold text-danger fs-5">{{ number_format($order->total_money, 0, ',', '.') }} đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
