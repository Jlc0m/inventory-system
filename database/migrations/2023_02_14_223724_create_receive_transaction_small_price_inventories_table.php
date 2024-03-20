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
        Schema::create('receive_transaction_small_price_inventories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('receipt_account_id');

            //Index
            $table->index('company_id', 'receive_transaction_small_price_inventory_company_idx');
            $table->index('city_id', 'receive_transaction_small_price_inventory_city_idx');
            $table->index('office_id', 'receive_transaction_small_price_inventory_office_idx');
            $table->index('stock_id', 'receive_transaction_small_price_inventory_stock_idx');
            $table->index('receipt_account_id', 'receipt_account_receive_transaction_small_price_inventory_idx');

            //Foreing
            $table->foreign('company_id', 'receive_transaction_small_price_inventory_company_fk')->on('companies')->references('id');
            $table->foreign('city_id', 'receive_transaction_small_price_inventory_city_fk')->on('cities')->references('id');
            $table->foreign('office_id', 'receive_transaction_small_price_inventory_office_fk')->on('offices')->references('id');
            $table->foreign('stock_id', 'receive_transaction_small_price_inventory_stock_fk')->on('stocks')->references('id');
            $table->foreign('receipt_account_id', 'receive_transaction_small_price_inventory_receipt_account_fk')->on('receipt_accounts')->references('id');


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
        Schema::dropIfExists('receive_transaction_small_price_inventories');
    }
};
