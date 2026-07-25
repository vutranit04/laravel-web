@extends('client.layouts.app')

@section('title', 'Danh mục: ' . $category->catename)

@section('content')
<h2 class="mb-4 fw-bold">Danh mục: {{ $category->catename }}</h2>

<div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
    @forelse ($products as $product)
        <x-client.product-item :product="$product" />
    @empty
        <div class="col-12"><p class="text-muted">Chưa có sản phẩm nào trong danh mục này.</p></div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
@endsection
