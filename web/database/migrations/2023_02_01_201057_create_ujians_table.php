<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->char('mapel', 2);
            $table->char('urut', 2);
            $table->char('id_soal', 2);
            $table->char('siswa', 20);
            $table->float('nilai', 16,2);
            $table->longText('deskripsi');
            $table->time('mulai');
            $table->time('selesai');
            $table->enum('stat', ['S', 'B']);
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
        Schema::dropIfExists('ujians');
    }
}
