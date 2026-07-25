@extends('client.layouts.app')

@section('title', 'Trang chủ - MyStore')

@section('content')

{{-- Banner Hero --}}
<div class="p-4 p-md-5 mb-4 text-white rounded bg-primary shadow-sm">
    <div class="col-md-8 px-0">
        <h1 class="display-5 fw-bold">Chào mừng bạn đến với MyStore</h1>
        <p class="lead my-3">Khám phá hàng ngàn sản phẩm công nghệ, thời trang và gia dụng mới nhất với mức giá cực kỳ ưu đãi!</p>
    </div>
</div>

{{-- Khu vực 1: Sản phẩm mới nhất --}}
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-dark m-0"><i class="bi bi-stars text-warning me-2"></i>Sản phẩm mới nhất</h3>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        @forelse ($latestProducts as $product)
            <x-client.product-item :product="$product" />
        @empty
            <div class="col-12"><p class="text-muted">Chưa có sản phẩm mới nào.</p></div>
        @endforelse
    </div>
</section>

{{-- Khu vực 2: Sản phẩm giảm giá, thanh lý --}}
@if ($discountProducts->count() > 0)
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-danger m-0"><i class="bi bi-lightning-charge-fill me-2"></i>Sản phẩm giảm giá / Khuyến mãi</h3>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        @foreach ($discountProducts as $product)
            <x-client.product-item :product="$product" />
        @endforeach
    </div>
</section>
@endif

{{-- Khu vực 3: Sản phẩm nổi bật --}}
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-dark m-0"><i class="bi bi-fire text-danger me-2"></i>Sản phẩm nổi bật</h3>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        @forelse ($featuredProducts as $product)
            <x-client.product-item :product="$product" />
        @empty
            <div class="col-12"><p class="text-muted">Chưa có sản phẩm nổi bật nào.</p></div>
        @endforelse
    </div>
</section>

@endsection
