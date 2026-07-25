

<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/demo', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
Route::get('/demo6/{id?}', [DemoController::class, 'index6']);

//Sử dụng prefix để tối các Route thay vì chỉ khai báo Route đơn thuần.
route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.home');
//goi 2 action test de kiem tra ket qua co chuyen trang hay khong
Route::get('/test1', [ProductController::class, 'test1']);
Route::get('/test2', [ProductController::class, 'test2']);



Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('/forgotpass', [AuthController::class, 'forgotPassword'])->name('forgotpass');
    Route::post('/forgotpass', [AuthController::class, 'postforgotPassword'])->name('forgotpass.post');
    Route::get('/resetpassword/{token}', [AuthController::class, 'resetPassword'])->name('resetpassword');
    Route::post('/resetpassword', [AuthController::class, 'postResetPassword'])->name('resetpassword.post');

    Route::middleware('auth')->group(function () {
        Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/changepassword', [AuthController::class, 'changePassword'])->name('changepassword');
        Route::post('/changepassword', [AuthController::class, 'postChangePassword'])->name('changepassword.post');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Xem danh sách sản phẩm dành cho cả Role 1 (Admin) và Role 2 (Nhân viên)
        Route::get('products', [ProductController::class, 'index'])->name('products.index')->middleware('roles:1,2');

        // CRUD - Resource routes dành riêng cho Admin (Role 1)
        Route::middleware('roles:1')->group(function () {
            // Thùng rác (Trash) & Khôi phục / Xóa vĩnh viễn Category
            Route::get('trash/categories', [CategoryController::class, 'trash'])->name('categories.trash');
            Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
            Route::delete('categories/{id}/forcedelete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
            Route::resource('categories', CategoryController::class);

            // Thùng rác (Trash) & Khôi phục / Xóa vĩnh viễn Brand
            Route::get('trash/brands', [BrandController::class, 'trash'])->name('brands.trash');
            Route::patch('brands/{id}/restore', [BrandController::class, 'restore'])->name('brands.restore');
            Route::delete('brands/{id}/forcedelete', [BrandController::class, 'forceDelete'])->name('brands.forceDelete');
            Route::resource('brands', BrandController::class);

            // Thùng rác (Trash) & Khôi phục / Xóa vĩnh viễn User
            Route::get('trash/users', [UserController::class, 'trash'])->name('users.trash');
            Route::patch('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
            Route::delete('users/{id}/forcedelete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
            Route::resource('users', UserController::class);

            // Thùng rác (Trash) & Khôi phục / Xóa vĩnh viễn Product
            Route::get('trash/products', [ProductController::class, 'trash'])->name('products.trash');
            Route::patch('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
            Route::delete('products/{id}/forcedelete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
            Route::resource('products', ProductController::class)->except(['index']);

            // Thùng rác (Trash) & Khôi phục / Xóa vĩnh viễn Post
            Route::get('trash/posts', [PostController::class, 'trash'])->name('posts.trash');
            Route::patch('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
            Route::delete('posts/{id}/forcedelete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
            Route::resource('posts', PostController::class);
        });
    });
});
