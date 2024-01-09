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
        Schema::create('fcs', function (Blueprint $table) {
            $table->increments('id_fc');
            $table->string('pn_after')->nullable();
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
        Schema::dropIfExists('fcs');
    }
}
