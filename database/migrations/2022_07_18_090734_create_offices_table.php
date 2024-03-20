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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('address')->nullable();

            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();

            $table->text('description')->nullable();

            //Index
            $table->index('country_id', 'office_country_idx');
            $table->index('company_id', 'office_company_idx');
            $table->index('city_id', 'office_city_idx');

            //Foreign
            $table->foreign('country_id', 'office_country_fk')->on('countries')->references('id');
            $table->foreign('company_id', 'office_company_fk')->on('companies')->references('id');
            $table->foreign('city_id', 'office_city_fk')->on('cities')->references('id');

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
        Schema::dropIfExists('offices');
    }
};
