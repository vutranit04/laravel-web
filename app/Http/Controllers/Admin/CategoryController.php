<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
    public function index($limit=10)
    {
        //==Query Builder
        // $list = DB::table('categories')
        //     ->select('cateid', 'catename', 'slug', 'image', 'status')
        //     ->where('status', 1)
        //     ->orderBy('catename')
        //     ->get();
        //==== ORM Eloquent
        $list=Category::select('cateid','catename','slug','image','status')
        ->orderBy('catename')
        ->paginate($limit);
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
        // DB::table('categories')->insert([
        //     'catename' => $request->catename,
        //     'slug' => $request->slug
        // ]);
        // return redirect()->route('admin.categories.index');
        //Eloquent ORM 
        try{
        Category::create([
            'catename'=>$request->catename,
            'slug'=>$request->slug,
            'description'=>$request->description,
            'image'=>$request->image,
            'status'=>$request->status,
        ]);
        return redirect()
        ->route('admin.categories.index')
        ->with('success','Thêm danh mục thành công!');
        }catch(\Exception $e){
            return back()
            ->withInput()
            ->with('error',$e->getMessage());
            
        }

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
    public function edit(string $cateid)
    { 
        
        $category=Category::find($cateid);
        return view('admin.categories.edit',compact('category'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cateid)
    {
        //Kiểm tra
        try{
           $category=Category::find($cateid);
           if(!$category)
            {
                return redirect()
                ->route('admin.categories.index')
                ->with('error','Danh mục không tồn tại');
            }
            //thực hiện cập nhật
            $category->update([
            'catename'=>$request->catename,
            'slug'=>$request->slug,
            'description'=>$request->description,
            'status'=>$request->status,
            ]);
            return redirect()
            ->route('admin.categories.index')
            ->with('success','Cập nhật danh mục thành công!');
            
        }catch(\Exception $e)
        {
            return back()
            ->withInput()
            ->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
