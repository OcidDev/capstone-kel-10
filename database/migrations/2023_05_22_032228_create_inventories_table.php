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
            $table->foreignId('cashier_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('inventories');
    }
};
