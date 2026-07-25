

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


Route::get('/demo',[DemoController::class,'index']);
Route::get('/demo2',[DemoController::class,'index2']);
Route::get('/demo3',[DemoController::class,'index3']);
Route::get('/demo4/{id}',[DemoController::class,'index4']);
Route::get('/demo5/{id?}',[DemoController::class,'index5']);
Route::get('/demo6/{id?}',[DemoController::class,'index6']);

//Sử dụng prefix để tối các Route thay vì chỉ khai báo Route đơn thuần.
route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.home');
//goi 2 action test de kiem tra ket qua co chuyen trang hay khong
Route::get('/test1', [ProductController::class,'test1']);
Route::get('/test2', [ProductController::class,'test2']);



Route::prefix('admin')->name('admin.')->group(function () {
// Authentication
Route::get('/login', [AuthController::class, 'login'])
->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])
->name('login.post');

Route::get('/forgotpass', [AuthController::class, 'forgotPassword'])
->name('forgotpass');
Route::post('/forgotpass', [AuthController::class, 'postforgotPassword'])
->name('forgotpass.post');

Route::get('/resetpassword/{token}', [AuthController::class, 'resetPassword'])
->name('resetpassword');
Route::post('/resetpassword', [AuthController::class, 'postResetPassword'])
->name('resetpassword.post');
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
->name('logout');
    Route::get('/changepassword', [AuthController::class, 'changePassword'])
->name('changepassword');
    Route::post('/changepassword', [AuthController::class, 'postChangePassword'])
->name('changepassword.post');
Route::get('/dashboard', [DashboardController::class, 'index'])
->name('dashboard');
Route::resource('/categories', CategoryController::class);
Route::resource('/brands', BrandController::class);
Route::resource('/products', ProductController::class);     
Route::resource('/users', UserController::class);
Route::resource('/posts',PostController::class);
});

});
