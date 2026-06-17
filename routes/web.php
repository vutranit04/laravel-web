

<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/demo',[DemoController::class,'index']);
Route::get('/demo2',[DemoController::class,'index2']);
Route::get('/demo3',[DemoController::class,'index3']);
Route::get('/demo4/{id}',[DemoController::class,'index4']);
Route::get('/demo5/{id?}',[DemoController::class,'index5']);
Route::get('/demo6/{id?}',[DemoController::class,'index6']);

//Sử dụng prefix để tối các Route thay vì chỉ khai báo Route đơn thuần.
Route::prefix('admin')-> name('admin.')->group(function () {
Route::resource('/categories', CategoryController::class);
Route::resource('/brands', BrandController::class);
Route::resource('/products', ProductController::class);
Route::resource('/users', UserController::class);
Route::resource('/posts',PostController::class);
});
route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.home');
//goi 2 action test de kiem tra ket qua co chuyen trang hay khong
Route::get('/test1', [ProductController::class,'test1']);
Route::get('/test2', [ProductController::class,'test2']);

