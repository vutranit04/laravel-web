<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Sản phẩm mới nhất (8 sản phẩm)
        $latestProducts = Product::where('status', 1)
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        // 2. Sản phẩm giảm giá (8 sản phẩm)
        $discountProducts = Product::where('status', 1)
            ->where('pricediscount', '>', 0)
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        // 3. Sản phẩm nổi bật / bán chạy (8 sản phẩm)
        $featuredProducts = Product::where('status', 1)
            ->orderBy('price', 'desc')
            ->take(8)
            ->get();

        return view('client.home.index', compact('latestProducts', 'discountProducts', 'featuredProducts'));
    }
}
