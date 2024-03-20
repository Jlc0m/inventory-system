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
        Schema::create('user_countries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');

            $table->index('user_id', 'user_country_user_idx');
            $table->index('country_id', 'user_country_country_idx');

            $table->foreign('user_id', 'user_country_user_fk')->on('users')->references('id');
            $table->foreign('country_id', 'user_country_country_fk')->on('countries')->references('id');

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
        Schema::dropIfExists('user_countries');
    }
};
