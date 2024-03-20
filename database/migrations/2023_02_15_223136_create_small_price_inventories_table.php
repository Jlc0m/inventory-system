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
        Schema::create('small_price_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('quantity')->default(0);

            $table->unsignedBigInteger('category_small_price_inventory_id');
            $table->unsignedBigInteger('receive_transaction_small_price_inventory_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('stock_id');
            
            //index
            $table->index('company_id', 'small_price_inventory_company_idx');
            $table->index('city_id', 'small_price_inventory_city_idx');
            $table->index('office_id', 'small_price_inventory_office_idx');
            $table->index('stock_id', 'small_price_inventory_stock_idx');
            $table->index('category_small_price_inventory_id', 'small_price_inventory_category_small_price_inventory_idx');
            $table->index('receive_transaction_small_price_inventory_id', 'small_price_inventory_receive_transaction_small_price_inventory_idx');

            //foreign
            $table->foreign('company_id', 'small_price_inventory_company_fk')->on('companies')->references('id');
            $table->foreign('city_id', 'small_price_inventory_city_fk')->on('cities')->references('id');
            $table->foreign('office_id', 'small_price_inventory_office_fk')->on('offices')->references('id');
            $table->foreign('stock_id', 'small_price_inventory_stock_fk')->on('stocks')->references('id');
            $table->foreign('category_small_price_inventory_id', 'small_price_inventories_category_small_price_inventories_id_fk')->on('category_small_price_inventories')->references('id');
            $table->foreign('receive_transaction_small_price_inventory_id', 'small_price_inventory_receive_transaction_small_price_inventory_fk')->on('receive_transaction_small_price_inventories')->references('id');

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
        Schema::dropIfExists('small_price_inventories');
    }
};
