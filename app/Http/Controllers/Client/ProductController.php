<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tất cả sản phẩm
     */
    public function index()
    {
        $products = Product::where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('client.product.index', compact('products'));
    }

    /**
     * Chi tiết sản phẩm theo Slug (không dùng ID)
     */
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with(['category', 'brand', 'images'])
            ->firstOrFail();

        // Sản phẩm liên quan cùng danh mục
        $relatedProducts = Product::where('cateid', $product->cateid)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->take(4)
            ->get();

        return view('client.product.show', compact('product', 'relatedProducts'));
    }

    /**
     * Tìm kiếm sản phẩm qua query string
     */
    public function search(Request $request)
    {
        $query = trim($request->input('query'));

        $products = Product::where('status', 1)
            ->when($query, function ($q) use ($query) {
                return $q->where('productname', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('client.product.search', compact('products', 'query'));
    }

    /**
     * Lọc sản phẩm theo Danh mục (dùng slug)
     */
    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('cateid', $category->cateid)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('client.product.category', compact('category', 'products'));
    }

    /**
     * Lọc sản phẩm theo Thương hiệu (dùng slug)
     */
    public function brand(string $slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        $products = Product::where('brandid', $brand->id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('client.product.brand', compact('brand', 'products'));
    }
}
