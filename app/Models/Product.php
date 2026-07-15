<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $primaryKey='id';
    protected $fillable=[
            'id',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image',
            'description',
            'status',

    ];
    //Cấu hình quan hệ với Category
    public function category()
    {
        //products.cateid = categories.cateid
        return $this->belongsTo(Category::class,'cateid','cateid');
    }
    //Cấu hình quan hệ với Brand
    public function brand()

    {
        //products.id = brands.id
        return $this->belongsTo(Brand::class,'brandid','id');
    }
}   
