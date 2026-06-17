<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $list = DB::table('categories')
            ->select('cateid', 'catename', 'slug', 'image', 'status')
            ->where('status', 1)
            ->orderBy('catename')
            ->get();
        return view('admin.categories.index', compact('list'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('categories')->insert([
            'catename' => $request->catename,
            'slug' => $request->slug
        ]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = 'Chi tiet san pham test';
        dump($id);
        return view('demoindex6', compact('data', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    { {
            $data = 'Sua san pham';
            dump($id);
            return view('demoindex6', compact('data', 'id'));
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
