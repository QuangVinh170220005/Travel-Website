<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->unsignedBigInteger('tour_id'); // ID tour
            $table->timestamps(); // created_at và updated_at

            // Khóa ngoại
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('tour_id')->references('tour_id')->on('tours')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
