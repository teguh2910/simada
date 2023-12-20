<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->increments('id_stock');
            $table->string('supplier');
            $table->string('pn_before');
            $table->string('pn_after');
            $table->string('part_name');
            $table->string('activity');
            $table->integer('stock');
            $table->integer('fc_aisin');
            $table->integer('incoming_supplier');
            $table->integer('gr_aisin');
            $table->integer('bulan');
            $table->integer('tahun');
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
        Schema::dropIfExists('stoks');
    }
}
