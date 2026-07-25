<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'productname',
        'slug',
        'price',
        'pricediscount',
        'image',
        'description',
        'status',
        'cateid',
        'brandid',

    ];
    //Cấu hình quan hệ với Category
    public function category()
    {
        //products.cateid = categories.cateid
        return $this->belongsTo(Category::class, 'cateid', 'cateid');
    }
    //Cấu hình quan hệ với Brand
    public function brand()

    {
        //products.id = brands.id
        return $this->belongsTo(Brand::class, 'brandid', 'id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
