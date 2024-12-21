<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('tour_schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->unsignedBigInteger('tour_id');
            $table->dateTime('departure_date');
            $table->text('description');
            $table->dateTime('return_date');
            $table->integer('available_slots');
            $table->enum('status', ['OPEN', 'FULL', 'COMPLETED', 'CANCELLED'])->default('OPEN');
            $table->string('meeting_point', 200)->nullable();
            $table->time('meeting_time')->nullable();
            $table->foreign('tour_id')->references('tour_id')->on('tours');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_schedules');
    }
}
