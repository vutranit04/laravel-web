
{{-- Thừa kế layouts/view/admin.blade.php  --}}
{{-- Resource views/admin/layouts/view/admin.blade.php  --}}
@extends('admin.layouts.admin')

{{-- Gán nội dung cho vùng section "title" --}}
{{-- Tương ứng với @yield(title) trong layout --}}
@section('title', 'Trang Admin')
@section('content')
<h1>Xin chào! <strong>Trần Minh Vũ</strong></h1> 
@endsection