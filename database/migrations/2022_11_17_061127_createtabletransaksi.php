<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createtabletransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id_transaction');
            $table->string('project');
            $table->date('due_date');
            $table->string('supplier');
            $table->string('part_number');
            $table->integer('status')->default(0);
            $table->unsignedInteger('id_document');
            $table->string('file')->nullable();
            $table->integer('revise')->default(0);
            $table->string('pic')->nullable();
            $table->string('npk')->nullable();
            $table->boolean('is_need')->default(true);
            $table->timestamps();

            $table->foreign('id_document')->references('id')->on('documents');
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
}
