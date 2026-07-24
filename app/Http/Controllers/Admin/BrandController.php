<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 5)
    {
        //   $list= DB::table('brands')
        // ->select ('id','brandname','slug','image','status')
        // ->where('status',1)
        // ->orderBy('brandname')
        // ->get();
        // return view ('admin.brands.index',compact('list'));
        //==================================================
        $list = Brand::select('id', 'brandname', 'slug', 'image', 'status')
            ->orderBy('brandname')
            ->paginate($limit);
        return view('admin.brands.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try {
            // upload hình ảnh (nếu có)
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->brandname)
                    . '-' . time()
                    . '.' . $file->extension();
                // hình ảnh được lưu vào thư mục storage/app/public/brands
                $file->storeAs('brands', $fileName, 'public');
            }
            Brand::create([
                'brandname' => $request->brandname,
                'slug' => $request->slug,
                'image' => $fileName,
                'status' => $request->status,
                'description' => $request->description,
            ]);
            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Thêm thương hiệu thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = 'Chi tiet thuong hieu';
        return view('', compact('brand', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        try {


            $brand = Brand::find($id);
            if (!$brand) {
                return redirect()
                    ->route('admin.brands.index')
                    ->with('error', 'Thương hiệu không tồn tại');
            }
            // Có chọn hình ảnh mới
            // Giữ tên hình ảnh cũ
            $fileName = $brand->image;
            if ($request->hasFile('img')) {
                // Xóa hình ảnh cũ
                if ($fileName) {
                    Storage::disk('public')->delete('brands/' . $brand->image);
                }
                // Upload hình ảnh mới
                $file = $request->file('img');
                $fileName = Str::slug($request->brandname)

                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('brands', $fileName, 'public');
            }
            $brand->update([
                'brandname' => $request->brandname,
                'slug' => $request->slug,
                'status' => $request->status,
                'image' => $fileName,
            ]);
            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Cập nhật thương hiệu thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
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
