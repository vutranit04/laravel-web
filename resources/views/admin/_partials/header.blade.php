<nav class="navbar navbar-light bg-light admin-header">
<div class="container-fluid">
<span class="navbar-brand">Admin Panel</span>
<div class="d-flex align-items-center gap-3">
@auth
<span>Xin chào <strong>{{ Auth::user()->fullname }}</strong></span>
<a href="{{ route('admin.changepassword') }}" class="text-decoration-none">
    <i class="bi bi-key me-1"></i>Đổi mật khẩu
</a>
<form action="{{ route('admin.logout') }}" method="POST" class="m-0">
@csrf
<button type="submit" class="btn btn-link p-0 text-decoration-none">
Đăng xuất
</button>
</form>
@endauth
</div>
</div>
</nav>