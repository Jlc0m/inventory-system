<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('city_id');

            $table->index('user_id', 'user_city_user_idx');
            $table->index('city_id', 'user_city_city_idx');

            $table->foreign('user_id', 'user_city_user_fk')->on('users')->references('id');
            $table->foreign('city_id', 'user_city_city_fk')->on('cities')->references('id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cities');
    }
};
