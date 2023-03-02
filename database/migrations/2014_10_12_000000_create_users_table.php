<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('slug', 200)->unique()->nullable();
            $table->string('name', 200);
            $table->string('restaurant_name', 200)->nullable();
            $table->string('image',5000)->nullable();
            $table->string('p_iva', 11)->unique();
            $table->string('address', 200);
            $table->string('phone', 20)->unique()->nullable();
            $table->decimal('delivery_cost', 9, 2)->default(0)->nullable();
            $table->time('opening_hours')->format('H:i')->nullable();
            $table->time('closing_hours')->format('H:i')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
