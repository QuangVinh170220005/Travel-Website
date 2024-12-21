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
            $table->string('location_name', 100);
            $table->string('location_address', 50);
            $table->string('coordinates')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('is_popular')->default(0);
            $table->string('best_time_to_visit', 100)->nullable();
            $table->text('weather_notes')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
        });
    }
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
