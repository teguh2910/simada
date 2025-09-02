<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKomentar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->increments('id_komentar');
            $table->unsignedInteger('id_transactions');
            $table->string('pic_k');
            $table->string('npk_k');
            $table->string('dep_k');
            $table->text('komentar');
            $table->timestamps();

            $table->foreign('id_transactions')->references('id_transaction')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komentars');
    }
}
