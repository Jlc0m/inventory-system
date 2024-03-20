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
        Schema::create('company_cities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('city_id');

            $table->index('company_id', 'company_city_company_idx');
            $table->index('city_id', 'company_city_city_idx');

            $table->foreign('company_id', 'company_city_company_fk')->on('companies')->references('id');
            $table->foreign('city_id', 'company_city_city_fk')->on('cities')->references('id');

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
        Schema::dropIfExists('company_cities');
    }
};
