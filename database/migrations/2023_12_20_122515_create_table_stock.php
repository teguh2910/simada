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
            $table->integer('fc_4');
            $table->integer('fc_5');
            $table->integer('fc_6');
            $table->integer('fc_7');
            $table->integer('fc_8');
            $table->integer('fc_9');
            $table->integer('fc_10');
            $table->integer('fc_11');
            $table->integer('fc_12');
            $table->integer('fc_1');
            $table->integer('fc_2');
            $table->integer('fc_3');
            $table->integer('incoming_supplier_4');
            $table->integer('incoming_supplier_5');
            $table->integer('incoming_supplier_6');
            $table->integer('incoming_supplier_7');
            $table->integer('incoming_supplier_8');
            $table->integer('incoming_supplier_9');
            $table->integer('incoming_supplier_10');
            $table->integer('incoming_supplier_11');
            $table->integer('incoming_supplier_12');
            $table->integer('incoming_supplier_1');
            $table->integer('incoming_supplier_2');
            $table->integer('incoming_supplier_3');
            $table->integer('gr_aisin_4');
            $table->integer('gr_aisin_5');
            $table->integer('gr_aisin_6');
            $table->integer('gr_aisin_7');
            $table->integer('gr_aisin_8');
            $table->integer('gr_aisin_9');
            $table->integer('gr_aisin_10');
            $table->integer('gr_aisin_11');
            $table->integer('gr_aisin_12');
            $table->integer('gr_aisin_1');
            $table->integer('gr_aisin_2');
            $table->integer('gr_aisin_3');
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
