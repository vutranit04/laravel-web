<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function test1()
    {
        return redirect()->route('admin.home');
    }
    public function test2()
    {
        return redirect('/admin/dashboard');
    }
    public function index($limit = 10)
    {
        //  $list = DB::table('products')
        //  ->join('categories', 'products.cateid', '=', 'categories.cateid')
        // ->leftJoin('brands', 'products.brandid', '=', 'brands.id')
        // ->select(
        //     'products.id',
        //     'products.productname',
        //     'products.slug',
        //     'products.price',
        //     'products.pricediscount',
        //     'products.image',
        //     'products.description',
        //     'products.status',
        //     'brands.brandname',
        //     'categories.catename'
        // )
        // ->where('products.status', 1)
        // ->orderBy('products.productname')
        // ->get();
        $list = Product::with([
            'category:cateid,catename',
            'brand:id,brandname'
        ])
            ->select(
                'id',
                'productname',
                'price',
                'image',
                'status',
                'cateid',
                'brandid'
            )
            ->orderBy('productname')
            ->paginate($limit);
        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('id', 'brandname')->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            // upload hình chinh
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->productname)
                    . '-' . time()
                    . '.' . $file->extension();
                // hình ảnh được lưu vào thư mục storage/app/public/products
                $file->storeAs('products', $fileName, 'public');
            }
            //Lưu
            $product = Product::create([
                'productname'   => $request->productname,
                'slug'          => $request->slug,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount ?? 0,
                'description'   => $request->description,
                'status'        => $request->status,
                'image' => $fileName,

            ]);
            // Upload hình ảnh phụ
            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time(); // cùng timestamp
                foreach ($request->file('imgs') as $file) {
                    // 15_1751363000_1.jpg
                    $fileName = $product->id
                        . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $fileName, 'public');
                    // Lưu vào bảng product_images
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileName,
                    ]);
                    $i++;
                }
            }
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //$product = Product::find(($id));
        $product = Product::with('images')->findOrFail(($id));
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('id', 'brandname')->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        //

        try {

            //Kiem tra loai san pham
            if (empty($request->cateid)) {
                return back()
                    ->withInput()
                    ->with('error', 'Vui lòng chọn loại sản phẩm!');
            }
            $product = Product::find($id);
            if (!$product) {
                return redirect()
                    ->route('admin.products.index')
                    ->with('error', 'Sản phẩm không tồn tại.');
            }
            // Có chọn hình ảnh mới
            // Giữ tên hình ảnh cũ
            $fileName = $product->image;
            if ($request->hasFile('img')) {
                // Xóa hình ảnh cũ
                if ($fileName) {
                    Storage::disk('public')->delete('products/' . $product->image);
                }
                // Upload hình ảnh mới
                $file = $request->file('img');
                $fileName = Str::slug($request->productname)

                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }
            //thuc hien cap nhat san pham
            $product->update([
                'productname' => $request->productname,
                'cateid' => $request->cateid,
                'brandid' => $request->brandid,
                'price' => $request->price,
                'pricediscount' => $request->pricediscount,
                'status' => $request->status,
                'description' => $request->description,
                'image' => $fileName,

            ]);
            // Upload hình ảnh phụ
            if ($request->hasFile('imgs')) {
                // Xóa hình ảnh phụ cũ
                foreach ($product->images as $image) {
                    Storage::disk('public')->delete('products/' . $image->image);
                    $image->delete();
                }
                $i = 1;
                $time = time();
                foreach ($request->file('imgs') as $file) {
                    $imgName = $product->id
                        . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $imgName, 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $imgName,
                    ]);
                    $i++;
                }
            }
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công!');
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
