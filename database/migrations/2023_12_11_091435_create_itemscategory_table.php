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
        Schema::create('itemscategory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ItemID');
            $table->unsignedBigInteger('CategoryID');
            $table->timestamps();
            $table->foreign('ItemID')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('CategoryID')->references('id')->on('categories')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemscategory');
    }
};
