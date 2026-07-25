@props(['product'])

@php
    $price = $product->price;
    $priceDiscount = $product->pricediscount;
    $hasDiscount = $priceDiscount > 0 && $priceDiscount < $price;
    $percent = $hasDiscount ? round((($price - $priceDiscount) / $price) * 100) : 0;
    $finalPrice = $hasDiscount ? $priceDiscount : $price;
@endphp

<div class="col">
    <div class="card h-100 shadow-sm position-relative product-card">
        @if ($hasDiscount)
            <span class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 fs-7 fw-bold rounded-end mt-2">
                -{{ $percent }}%
            </span>
        @endif

        <a href="{{ route('products.show', $product->slug) }}">
            <img src="{{ $product->image ? asset('storage/products/' . $product->image) : 'https://via.placeholder.com/300x200' }}" 
                 class="card-img-top p-2" 
                 alt="{{ $product->productname }}" 
                 style="height: 200px; object-fit: contain;">
        </a>

        <div class="card-body d-flex flex-column">
            <h6 class="card-title text-truncate">
                <a href="{{ route('products.show', $product->slug) }}" class="text-dark text-decoration-none" title="{{ $product->productname }}">
                    {{ $product->productname }}
                </a>
            </h6>

            <div class="mt-auto mb-2">
                @if ($hasDiscount)
                    <div class="fw-bold text-danger fs-6">{{ number_format($finalPrice, 0, ',', '.') }} đ</div>
                    <small class="text-muted text-decoration-line-through">{{ number_format($price, 0, ',', '.') }} đ</small>
                @else
                    <div class="fw-bold text-primary fs-6">{{ number_format($price, 0, ',', '.') }} đ</div>
                @endif
            </div>

            <div class="d-grid gap-1">
                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                    @csrf
                    <input type="hidden" name="productid" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                        <i class="bi bi-cart-plus me-1"></i>Thêm vào giỏ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
