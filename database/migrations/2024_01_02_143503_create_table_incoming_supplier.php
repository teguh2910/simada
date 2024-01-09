<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIncomingSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_suppliers', function (Blueprint $table) {
            $table->increments('id_incoming_supplier');
            $table->string('pn_after')->nullable();            
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
        Schema::dropIfExists('incoming_suppliers');
    }
}
