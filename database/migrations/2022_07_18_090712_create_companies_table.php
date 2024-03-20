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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->unsignedBigInteger('country_id')->nullable();

            $table->string('address')->nullable();
            $table->string('requisites')->nullable();
            $table->string('accountant')->nullable();
            $table->string('taxation')->nullable();
            
            $table->text('description')->nullable();

            //Index
            $table->index('country_id', 'company_country_idx');

            //Foreign
            $table->foreign('country_id', 'company_country_fk')->on('countries')->references('id');

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
        Schema::dropIfExists('companies');
    }
};
