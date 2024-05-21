<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->char('mapel', 2);
            $table->char('urut', 2);
            $table->char('siswa', 20);
            $table->float('nilai', 3,2);
            $table->datetime('mulai');
            $table->longText('deskripsi');
            $table->datetime('selesai');
            $table->string('file');
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
        Schema::dropIfExists('tugas');
    }
}
