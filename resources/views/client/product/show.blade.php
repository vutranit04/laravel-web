@extends('client.layouts.app')

@section('title', $product->productname)

@section('content')
@php
    $price = $product->price;
    $priceDiscount = $product->pricediscount;
    $hasDiscount = $priceDiscount > 0 && $priceDiscount < $price;
    $finalPrice = $hasDiscount ? $priceDiscount : $price;
@endphp

<div class="bg-white p-4 rounded shadow-sm mb-5">
    <div class="row">
        {{-- Hình ảnh sản phẩm --}}
        <div class="col-md-5 mb-3 mb-md-0">
            <div class="text-center mb-3">
                <img id="mainProductImg" 
                     src="{{ $product->image ? asset('storage/products/' . $product->image) : 'https://via.placeholder.com/400' }}" 
                     alt="{{ $product->productname }}" 
                     class="img-fluid rounded border p-2" 
                     style="max-height: 350px; object-fit: contain;">
            </div>

            {{-- Hình ảnh phụ --}}
            @if ($product->images && $product->images->count() > 0)
                <div class="d-flex gap-2 overflow-auto justify-content-center">
                    <img src="{{ asset('storage/products/' . $product->image) }}" 
                         class="img-thumbnail cursor-pointer" 
                         style="width: 70px; height: 70px; object-fit: cover;" 
                         onclick="document.getElementById('mainProductImg').src=this.src">
                    @foreach ($product->images as $subImg)
                        <img src="{{ asset('storage/products/' . $subImg->image) }}" 
                             class="img-thumbnail cursor-pointer" 
                             style="width: 70px; height: 70px; object-fit: cover;" 
                             onclick="document.getElementById('mainProductImg').src=this.src">
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Thông tin sản phẩm --}}
        <div class="col-md-7">
            <h2 class="fw-bold mb-3">{{ $product->productname }}</h2>

            <div class="mb-3">
                <span class="text-muted">Danh mục: </span>
                <a href="{{ route('products.category', $product->category->slug ?? '') }}" class="text-decoration-none fw-semibold">
                    {{ $product->category->catename ?? 'Khác' }}
                </a>
                @if ($product->brand)
                    <span class="text-muted ms-3">Thương hiệu: </span>
                    <a href="{{ route('products.brand', $product->brand->slug ?? '') }}" class="text-decoration-none fw-semibold">
                        {{ $product->brand->brandname }}
                    </a>
                @endif
            </div>

            <div class="p-3 bg-light rounded mb-4">
                @if ($hasDiscount)
                    <div class="d-flex align-items-baseline gap-3">
                        <span class="fs-2 fw-bold text-danger">{{ number_format($finalPrice, 0, ',', '.') }} đ</span>
                        <span class="text-muted text-decoration-line-through fs-5">{{ number_format($price, 0, ',', '.') }} đ</span>
                    </div>
                @else
                    <span class="fs-2 fw-bold text-primary">{{ number_format($price, 0, ',', '.') }} đ</span>
                @endif
            </div>

            {{-- Form Thêm vào giỏ hàng --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="productid" value="{{ $product->id }}">
                
                <div class="d-flex align-items-center gap-3 mb-3">
                    <label for="quantity" class="fw-bold">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="100" class="form-control text-center" style="width: 100px;">
                </div>

                <button type="submit" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ hàng
                </button>
            </form>

            <div>
                <h5 class="fw-bold border-bottom pb-2">Mô tả sản phẩm</h5>
                <p class="text-secondary">{!! nl2br(e($product->description)) !!}</p>
            </div>
        </div>
    </div>
</div>

{{-- Sản phẩm liên quan --}}
@if ($relatedProducts->count() > 0)
<section>
    <h3 class="fw-bold mb-3">Sản phẩm liên quan</h3>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        @foreach ($relatedProducts as $item)
            <x-client.product-item :product="$item" />
        @endforeach
    </div>
</section>
@endif
@endsection
