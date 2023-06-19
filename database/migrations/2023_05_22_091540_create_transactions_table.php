<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('buyer_id')->nullable()->references('id')->on('buyers')->onDelete('cascade');
            $table->string('invoice_code');
            $table->integer('total')->unsigned();
            $table->enum('status', ['LUNAS', 'BELUM LUNAS'])->default('LUNAS');
            $table->integer('cash')->unsigned();
            $table->integer('change')->unsigned();
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
        Schema::dropIfExists('transactions');
    }
};
