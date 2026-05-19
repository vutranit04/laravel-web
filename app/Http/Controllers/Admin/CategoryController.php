<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// <!-- Họ tên: Trần Minh Vũ
// MSSV:2122110359
// Ngày tạo: 19/05/2026
// Nội dung: Cập nhật các route resource CRUD  -->
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Danh sách các danh mục';
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'Form tạo sản phẩm';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      return 'Lưu sản sản phẩm danh mục mới';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $data= 'Chi tiet san pham test';
        dump($id);
        return view('demoindex6',compact('data','id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            {
         $data= 'Sua san pham';
        dump($id);
        return view('demoindex6',compact('data','id'));
    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
