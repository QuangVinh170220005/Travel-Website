<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('location_id');
            $table->string('location_name', 100)->charset('utf8mb4');
            $table->string('location_address', 50)->charset('utf8mb4');
            $table->text('description')->nullable()->charset('utf8mb4');
            $table->string('location_map', 255)->nullable()->charset('utf8');
            $table->tinyInteger('is_popular')->default(0);
            $table->string('best_time_to_visit', 100)->nullable()->charset('utf8mb4');
            $table->text('weather_notes')->nullable()->charset('utf8mb4');
            $table->timestamp('created_at');
        });
    }
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
