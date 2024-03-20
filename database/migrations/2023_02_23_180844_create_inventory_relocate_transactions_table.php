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
        Schema::create('inventory_relocate_transactions', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('office_id');


            $table->boolean('status')->default(false);
            $table->boolean('approved')->default(false);

            $table->text('description')->nullable();

            $table->foreign('user_id', 'user_inventory_relocate_transaction_fk')->on('users')->references('id');
            $table->foreign('company_id', 'company_inventory_relocate_transaction_fk')->on('companies')->references('id');
            $table->foreign('city_id', 'city_inventory_relocate_transaction_fk')->on('cities')->references('id');
            $table->foreign('office_id', 'office_inventory_relocate_transaction_fk')->on('offices')->references('id');
            

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
        Schema::dropIfExists('inventory_relocate_transactions');
    }
};
