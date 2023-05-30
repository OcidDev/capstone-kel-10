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
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('cash')->unsigned()->after('buyer_phone');
            $table->integer('change')->unsigned()->after('cash');
            $table->enum('incoming_items', ['true', 'false'])->after('change');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('cash');
            $table->dropColumn('change');
            $table->dropColumn('incoming_items');
        });
    }
};
