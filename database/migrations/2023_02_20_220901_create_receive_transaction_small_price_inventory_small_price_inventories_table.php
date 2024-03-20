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
        Schema::create('receive_transaction_small_price_inventory_small_price_inventories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('receive_transaction_small_price_inventory_id');
            $table->unsignedBigInteger('small_price_inventory_id');

            $table->foreign('receive_transaction_small_price_inventory_id', 'small_price_inventory_receive_transaction_small_price_inventory_id_fk')->on('receive_transaction_small_price_inventories')->references('id');
            $table->foreign('small_price_inventory_id', 'receive_transaction_small_price_inventory_small_price_inventory_fk')->on('small_price_inventories')->references('id');

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
        Schema::dropIfExists('receive_transaction_small_price_inventory_small_price_inventories');
    }
};
