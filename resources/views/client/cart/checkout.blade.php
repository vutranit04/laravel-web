@extends('client.layouts.app')

@section('title', 'Thanh toán & Đặt hàng')

@section('content')
<h2 class="mb-4 fw-bold"><i class="bi bi-credit-card me-2"></i>Thanh toán & Đặt hàng</h2>

<form action="{{ route('cart.postCheckout') }}" method="POST">
    @csrf
    <div class="row">
        {{-- Thông tin giao hàng --}}
        <div class="col-lg-7 mb-4">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Thông tin nhận hàng (Không cần đăng nhập)</h5>

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nguyễn Văn A">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label fw-semibold">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="0901234567">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-semibold">Email (Không bắt buộc)</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@example.com">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                    <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Số nhà, Tên đường, Phường/Xã, Quận/Huyện, Tỉnh/TP">
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label fw-semibold">Ghi chú đơn hàng</label>
                    <textarea id="note" name="note" rows="3" class="form-control" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian giao hàng..."></textarea>
                </div>
            </div>
        </div>

        {{-- Tóm tắt đơn hàng --}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Đơn hàng của bạn</h5>

                <ul class="list-group list-group-flush mb-3">
                    @php $totalMoney = 0; @endphp
                    @foreach ($cart as $item)
                        @php
                            $subTotal = $item['price'] * $item['quantity'];
                            $totalMoney += $subTotal;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h6 class="my-0 text-truncate" style="max-width: 220px;">{{ $item['proname'] }}</h6>
                                <small class="text-muted">SL: {{ $item['quantity'] }} x {{ number_format($item['price'], 0, ',', '.') }} đ</small>
                            </div>
                            <span class="fw-bold">{{ number_format($subTotal, 0, ',', '.') }} đ</span>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-between mb-4 fs-5 border-top pt-3">
                    <span>Tổng tiền thanh toán:</span>
                    <span class="fw-bold text-danger">{{ number_format($totalMoney, 0, ',', '.') }} đ</span>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-check-circle me-2"></i>Xác nhận Đặt hàng
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
