<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code',255)->nullable();
            $table->datetime('exp')->nullable();
            $table->integer('discount')->nullable();
            $table->tinyInteger('status')->default(0);
        });
    }
    public function down()
    {
        Schema::dropIfExists('promotion');
    }
};
