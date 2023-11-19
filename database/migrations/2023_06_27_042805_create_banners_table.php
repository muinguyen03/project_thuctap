<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('url',255)->nullable();
            $table->tinyInteger('status')->default(0);
        });
    }
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
