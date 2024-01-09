<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGrAisin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gr_aisins', function (Blueprint $table) {
            $table->increments('id_gr_aisin');;
            $table->string('pn_after')->nullable();
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
        Schema::dropIfExists('gr_aisins');
    }
}
