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
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignid('transactions_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->foreignid('products_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('product_name');
            $table->integer('product_price')->unsigned();
            $table->integer('product_capital_price')->unsigned();
            $table->integer('qty')->unsigned();
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
        Schema::dropIfExists('detail_transactions');
    }
};
