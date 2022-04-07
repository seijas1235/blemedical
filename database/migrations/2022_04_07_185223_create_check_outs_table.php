<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record')->references('id')->on('records')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('ckeck_out');
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
        Schema::dropIfExists('check_outs');
    }
}
