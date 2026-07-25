@extends('admin.layouts.admin')

@section('title', 'Quản lý Đơn hàng')

@section('content')
<h2 class="mb-3">DANH SÁCH ĐƠN ĐẶT HÀNG</h2>

<x-admin.alert />

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Mã ĐH</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Tổng tiền</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                <td>{{ $order->customer->phone ?? 'N/A' }}</td>
                <td class="fw-bold text-danger">{{ number_format($order->total_money, 0, ',', '.') }} đ</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($order->status == 0)
                        <span class="badge bg-warning text-dark">Mới đặt</span>
                    @elseif($order->status == 1)
                        <span class="badge bg-info text-dark">Đã xác nhận</span>
                    @elseif($order->status == 2)
                        <span class="badge bg-primary">Đang giao</span>
                    @elseif($order->status == 3)
                        <span class="badge bg-success">Hoàn thành</span>
                    @else
                        <span class="badge bg-danger">Đã hủy</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-eye"></i> Chi tiết
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection
