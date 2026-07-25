<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    //chi dinh  ten bang gtrong database 
    //(co the bo qua khai bai $table neu dat theo nguyen tac so nhieu  )
    protected $table='posts';
    //khong chi dinh khoa chinh vi primarykey cua bang nay la id
    //cac cot cho phep them sua du lieu hang loat
    //join bang user
    // Tham số 1: Model liên kết (User)
        // Tham số 2: Tên cột khóa ngoại trong bảng posts ('userid')
        // Tham số 3: Tên cột khóa chính trong bảng users ('id')
      public function user()
{
    return $this->belongsTo(User::class, 'userid', 'id');
}
    protected $fillable = [
      'title',
      'slug',
      'content',
      'image',
      'status',
      'userid',
      'created_at',
    ];

}
