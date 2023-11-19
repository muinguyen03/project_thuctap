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
        Schema::connection('mongodb')->create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',255)->nullable();
            $table->integer('order_code')->nullable();
            $table->string('order_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->integer('total')->nullable();
            $table->string('user')->nullable();
            $table->string('note')->nullable();
            $table->string('promotion')->nullable();
            $table->tinyInteger('tracking')->nullable();
            $table->tinyInteger('status_payment')->nullable();
            $table->integer('ship')->nullable();
            $table->integer('subtotal')->nullable();
            $table->string('carriers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
