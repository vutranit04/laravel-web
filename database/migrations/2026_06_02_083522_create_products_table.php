<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productname',150);
            $table->string('slug',200)->unique();
            //gia ban
            $table->decimal('price',12,2)->default(0);
            //gia sau khi duoc giam
            $table->decimal('pricediscount',12,2)->default(0);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();

            //=============================================
            //khoa ngoai toi bang brands
            $table->foreignId('brandid')
            ->nullable()
            ->constrained('brands')
            ->nullOnDelete();
              //=============================================
            //khoa ngoai toi bang categories
              $table->unsignedInteger('cateid');
              $table->foreign('cateid')
              ->references('cateid')
              ->on('categories')
            ->restrictOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
