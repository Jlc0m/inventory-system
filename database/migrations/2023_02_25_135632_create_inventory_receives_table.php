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
        Schema::create('inventory_receives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('inventory_receive_transaction_id');

            $table->timestamps();

            $table->index('inventory_id', 'inventory_inventory_receive_transaction_inventory_idx');
            $table->index('inventory_receive_transaction_id', 'inventory_inventory_receive_transaction_inventory_receive_transaction_idx');

            $table->foreign('inventory_id', 'inventory_inventory_receive_transaction_inventory_fk')->on('inventories')->references('id');
            $table->foreign('inventory_receive_transaction_id', 'inventory_inventory_receive_transaction_inventory_receive_transaction_fk')->on('inventory_receive_transactions')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_receives');
    }
};
