<!-- Họ tên: Trần Minh Vũ
Ngày 02/06/2026
Nội dung: Dùng lệnh migration create để tại bảng và cập nhật các cấu trúc cho bảng users -->


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',100);
            $table->string('username',30)->unique();
            $table->string('email',50)->unique();
            $table->string('password',150);
            $table->string('phone',20)->unique();
            $table->string('address',255)->nullable();
            $table->tinyInteger('gender')->default(0);
            $table->date('birthday');
            $table->unsignedTinyInteger('role')->default(2);
            $table->tinyInteger('status')->default(1);
            $table->rememberToken(); // Thêm cột remember_token
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
