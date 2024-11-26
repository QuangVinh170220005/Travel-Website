<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('remember_token',50);
            $table->string('full_name', 100);
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('id_card', 20)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->enum('role', ['ADMIN', 'STAFF', 'CUSTOMER'])->default('CUSTOMER');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
