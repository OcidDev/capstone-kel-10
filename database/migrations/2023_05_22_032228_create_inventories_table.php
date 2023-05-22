<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suppliers_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreignId('products_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('invoice_code');
            $table->date('date')->nullable()->default(Carbon::now());
            $table->integer('qty')->unsigned();
            $table->integer('total')->unsigned();
            $table->string('status')->default('LUNAS');
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
        Schema::dropIfExists('inventories');
    }
};
