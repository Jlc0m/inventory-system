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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();

            $table->unsignedBigInteger('condition_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();

            $table->index('condition_id', 'user_condition_idx');
            $table->index('department_id', 'user_department_idx');
            $table->index('category_id', 'user_category_idx');

            $table->foreign('condition_id', 'user_condition_fk')->on('conditions')->references('id');
            $table->foreign('category_id', 'user_category_fk')->on('categories')->references('id');
            $table->foreign('department_id', 'user_department_fk')->on('departments')->references('id');

            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
};
