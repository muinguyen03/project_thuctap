<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('id_product',255)->nullable();
            $table->string('id_user',255)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('options')->nullable();
            $table->integer('id_item')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
