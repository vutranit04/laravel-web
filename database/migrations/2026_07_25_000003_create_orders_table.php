<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->decimal('total_money', 12, 2)->default(0);
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Mới, 1: Đã xác nhận, 2: Đang giao, 3: Hoàn thành, 4: Đã hủy');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
