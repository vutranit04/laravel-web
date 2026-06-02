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
        Schema::create('posts', function (Blueprint $table) {
             $table->id();
            $table->string('title',200);
            $table->string('slug',255)->unique();
            $table->text('content');
            $table->string('image',200);
            $table->tinyInteger('status')->default(1);
            $table->bigInteger('user_id');
            $table->timestamps();
             //=============================================
            //khoa ngoai toi bang users
            $table->foreignId('userid')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
