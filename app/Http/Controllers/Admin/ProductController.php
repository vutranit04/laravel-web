<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function index($limit=10)
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
    $list=Product::with([
        'category:cateid,catename',
        'brand:id,brandname'
    ])
    ->select (
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
        return 'Tạo sản phẩm mới';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
