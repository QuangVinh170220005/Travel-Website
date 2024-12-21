<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tour_id');
            $table->unsignedBigInteger('schedule_id');
            $table->timestamp('booking_date')->useCurrent();
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['PENDING', 'CONFIRMED', 'PAID', 'CANCELLED'])->default('PENDING');
            $table->text('special_requests')->nullable();
            $table->decimal('deposit_amount', 12, 2)->default(0);
            $table->boolean('need_pickup')->default(false);
            $table->text('pickup_location')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('tour_id')->references('tour_id')->on('tours');
            $table->foreign('schedule_id')->references('schedule_id')->on('tour_schedules');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
