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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('shelves_id')->references('id')->on('shelves')->onDelete('cascade');
            $table->string('product_code');
            $table->string('name');
            $table->string('image');
            $table->string('description')->nullable();
            $table->integer('price')->unsigned();
            $table->integer('capital_price')->unsigned();
            $table->integer('stock')->unsigned()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
