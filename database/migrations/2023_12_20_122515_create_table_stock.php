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
            $table->string('supplier')->nullable();
            $table->string('pn_before')->nullable();
            $table->string('pn_after')->nullable();
            $table->string('part_name')->nullable();
            $table->string('activity')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('fc_4')->nullable();
            $table->integer('fc_5')->nullable();
            $table->integer('fc_6')->nullable();
            $table->integer('fc_7')->nullable();
            $table->integer('fc_8')->nullable();
            $table->integer('fc_9')->nullable();
            $table->integer('fc_10')->nullable();
            $table->integer('fc_11')->nullable();
            $table->integer('fc_12')->nullable();
            $table->integer('fc_1')->nullable();
            $table->integer('fc_2')->nullable();
            $table->integer('fc_3')->nullable();
            $table->integer('incoming_supplier_4')->nullable();
            $table->integer('incoming_supplier_5')->nullable();
            $table->integer('incoming_supplier_6')->nullable();
            $table->integer('incoming_supplier_7')->nullable();
            $table->integer('incoming_supplier_8')->nullable();
            $table->integer('incoming_supplier_9')->nullable();
            $table->integer('incoming_supplier_10')->nullable();
            $table->integer('incoming_supplier_11')->nullable();
            $table->integer('incoming_supplier_12')->nullable();
            $table->integer('incoming_supplier_1')->nullable();
            $table->integer('incoming_supplier_2')->nullable();
            $table->integer('incoming_supplier_3')->nullable();
            $table->integer('gr_aisin_4')->nullable();
            $table->integer('gr_aisin_5')->nullable();
            $table->integer('gr_aisin_6')->nullable();
            $table->integer('gr_aisin_7')->nullable();
            $table->integer('gr_aisin_8')->nullable();
            $table->integer('gr_aisin_9')->nullable();
            $table->integer('gr_aisin_10')->nullable();
            $table->integer('gr_aisin_11')->nullable();
            $table->integer('gr_aisin_12')->nullable();
            $table->integer('gr_aisin_1')->nullable();
            $table->integer('gr_aisin_2')->nullable();
            $table->integer('gr_aisin_3')->nullable();
            $table->integer('tahun')->nullable();
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
