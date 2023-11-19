<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
            $table->integer('price')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('weight')->nullable();
            $table->string('dimension')->nullable();
            $table->text('description')->nullable();
            $table->text('description_sort')->nullable();
            $table->string('category_id')->nullable();
            $table->tinyInteger('status')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
