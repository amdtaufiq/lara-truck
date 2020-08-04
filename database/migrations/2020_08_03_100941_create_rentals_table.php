<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyewa');
            $table->string('nomor');
            $table->unsignedBigInteger('truk_id');
            $table->foreign('truk_id')->references('id')->on('truks')
                    ->onDelete('cascade')->onUpdate('cascade')->change();
            $table->string('durasi');
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
        Schema::dropIfExists('rentals');
    }
}
