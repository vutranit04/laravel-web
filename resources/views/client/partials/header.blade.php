<header class="bg-white border-bottom py-3">
    <div class="container d-flex align-items-center justify-content-between gap-3">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="navbar-brand text-primary fw-bold fs-3 m-0">
            <i class="bi bi-shop me-2"></i>MyStore
        </a>

        {{-- Thanh tìm kiếm --}}
        <form action="{{ route('products.search') }}" method="GET" class="flex-grow-1 mx-4" style="max-width: 500px;">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Nhập tên sản phẩm cần tìm..." value="{{ request('query') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search me-1"></i>Tìm kiếm
                </button>
            </div>
        </form>

        {{-- Biểu tượng Giỏ hàng --}}
        @php
            $cart = session('cart', []);
            $totalCount = array_sum(array_column($cart, 'quantity'));
        @endphp
        <a href="{{ route('cart.index') }}" class="btn btn-outline-primary position-relative">
            <i class="bi bi-cart3 fs-5 me-1"></i> Giỏ hàng
            @if ($totalCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $totalCount }}
                </span>
            @endif
        </a>
    </div>
</header>
