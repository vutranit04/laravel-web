@php
    $categories = App\Models\Category::where('status', 1)->orderBy('catename')->get();
    $brands = App\Models\Brand::where('status', 1)->orderBy('brandname')->get();
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#clientNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="clientNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i>Trang chủ
                    </a>
                </li>
                
                {{-- Dropdown Loại sản phẩm --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-grid me-1"></i>Danh mục
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $cate)
                            <li>
                                <a class="dropdown-item" href="{{ route('products.category', $cate->slug) }}">
                                    {{ $cate->catename }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                {{-- Dropdown Thương hiệu --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="brandDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-award me-1"></i>Thương hiệu
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($brands as $b)
                            <li>
                                <a class="dropdown-item" href="{{ route('products.brand', $b->slug) }}">
                                    {{ $b->brandname }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
