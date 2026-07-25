@extends('client.layouts.app')

@section('title', 'Kết quả tìm kiếm: ' . $query)

@section('content')
<h2 class="mb-4 fw-bold">Kết quả tìm kiếm cho từ khóa: <span class="text-primary">"{{ $query }}"</span></h2>

<div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
    @forelse ($products as $product)
        <x-client.product-item :product="$product" />
    @empty
        <div class="col-12">
            <div class="alert alert-warning">
                Không tìm thấy sản phẩm nào phù hợp với từ khóa "{{ $query }}".
            </div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
@endsection
