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
        Schema::create('inventories', function (Blueprint $table) {
            
            $table->id();

            $table->string('name');
            
            $table->string('interior_number')->unique();
            $table->string('external_number')->nullable()->unique();

            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();
            $table->unsignedBigInteger('stock_id')->nullable();
            $table->unsignedBigInteger('condition_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('invoice')->nullable();
            $table->string('delivery_note')->nullable();

            $table->text('description')->nullable();

            //Index
            $table->index('country_id', 'inventory_country_idx');
            $table->index('company_id', 'inventory_company_idx');
            $table->index('city_id', 'inventory_city_idx');
            $table->index('office_id', 'inventory_office_idx');
            $table->index('stock_id', 'inventory_stock_idx');
            $table->index('condition_id', 'inventory_condition_idx');
            $table->index('category_id', 'inventory_category_idx');
            $table->index('subcategory_id', 'inventory_subcategory_idx');
            $table->index('department_id', 'inventory_department_idx');
            $table->index('user_id', 'inventory_user_idx');

            //Foreing
            $table->foreign('country_id', 'inventory_country_fk')->on('countries')->references('id');
            $table->foreign('company_id', 'inventory_company_fk')->on('companies')->references('id');
            $table->foreign('city_id', 'inventory_city_fk')->on('cities')->references('id');
            $table->foreign('office_id', 'inventory_office_fk')->on('offices')->references('id');
            $table->foreign('stock_id', 'inventory_stock_fk')->on('stocks')->references('id');
            $table->foreign('condition_id', 'inventory_condition_fk')->on('conditions')->references('id');
            $table->foreign('category_id', 'inventory_category_fk')->on('categories')->references('id');
            $table->foreign('subcategory_id', 'inventory_subcategory_fk')->on('subcategories')->references('id');
            $table->foreign('department_id', 'inventory_department_fk')->on('departments')->references('id');
            $table->foreign('user_id', 'inventory_user_fk')->on('users')->references('id');

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
        Schema::dropIfExists('inventories');
    }
};
