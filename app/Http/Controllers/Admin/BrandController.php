<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit=5)
    {
        //   $list= DB::table('brands')
        // ->select ('id','brandname','slug','image','status')
        // ->where('status',1)
        // ->orderBy('brandname')
        // ->get();
        // return view ('admin.brands.index',compact('list'));
        //==================================================
        $list=Brand::select('id','brandname','slug','image','status')
        ->where('status',1)
        ->orderBy('brandname')
         ->paginate($limit);
        return view('admin.brands.index',compact('list'));
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
    public function store(Request $request)
    {
            Brand::create([
            'brandname'=>$request->brandname,
            'slug'=>$request->slug,
            'image'=>$request->image,
            'status'=>$request->status,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand='Chi tiet thuong hieu';
        return view('',compact('brand','id'));

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
