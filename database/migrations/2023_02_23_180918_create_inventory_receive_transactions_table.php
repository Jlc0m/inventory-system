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
        Schema::create('inventory_receive_transactions', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('inventory_relocate_transaction_id')->nullable();

            $table->boolean('status')->default(false);

            $table->text('description')->nullable();

            $table->foreign('user_id', 'user_inventory_receive_transaction_fk')->on('users')->references('id');
            $table->foreign('company_id', 'company_inventory_receive_transaction_fk')->on('companies')->references('id');
            $table->foreign('city_id', 'city_inventory_receive_transaction_fk')->on('cities')->references('id');
            $table->foreign('inventory_relocate_transaction_id', 'inventory_relocate_transaction_inventory_receive_transaction_fk')->on('inventory_relocate_transactions')->references('id');
            $table->foreign('office_id', 'office_inventory_receive_transaction_fk')->on('offices')->references('id');
            
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
        Schema::dropIfExists('inventory_receive_transactions');
    }
};
