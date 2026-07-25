<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    //chi dinh  ten bang gtrong database 
    //(co the bo qua khai bai $table neu dat theo nguyen tac so nhieu  )
    protected $table='categories';
    //chi dinh khoa chinh
    //co the bo qua khai bao $primarykey neu primary key la id
    protected $primaryKey='cateid';
    //cac cot cho phep them sua du lieu hang loat
    protected $fillable = [
        'catename',
        'slug',
        'description',
        'image',
        'status',
    ];

}
