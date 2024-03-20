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
        Schema::create('invcomments', function (Blueprint $table) {
            $table->id();

            $table->text('title');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('inventory_id')->nullable();

            $table->index('user_id', 'invcomment_user_idx');
            $table->index('inventory_id', 'invcomment_inventory_idx');

            $table->foreign('user_id', 'invcomment_user_fk')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('inventory_id', 'invcomment_inventory_fk')->on('inventories')->references('id')->cascadeOnDelete();

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
        Schema::dropIfExists('invcomments');
    }
};
