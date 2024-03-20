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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();

            $table->text('description')->nullable();

            //Index
            $table->index('country_id', 'stock_country_idx');
            $table->index('company_id', 'stock_company_idx');
            $table->index('city_id', 'stock_city_idx');
            $table->index('office_id', 'stock_office_idx');

            //Foreign
            $table->foreign('country_id', 'stock_country_fk')->on('countries')->references('id');
            $table->foreign('company_id', 'stock_company_fk')->on('companies')->references('id');
            $table->foreign('city_id', 'stock_city_fk')->on('cities')->references('id');
            $table->foreign('office_id', 'stock_office_fk')->on('offices')->references('id');

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
        Schema::dropIfExists('stocks');
    }
};
