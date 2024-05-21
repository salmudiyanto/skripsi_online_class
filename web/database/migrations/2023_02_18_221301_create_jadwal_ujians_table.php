<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_ujians', function (Blueprint $table) {
            $table->id();
            $table->char('mapel', 20);
            $table->char('kelas', 20);
            $table->char('urut', 12);
            $table->char('pilgan', 12);
            $table->char('essay', 12);
            $table->date('tanggal');
            $table->time('jam');
            $table->char('lama', 12);
            $table->enum('stat', ['S', 'B']);
            $table->longText('qr');
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
        Schema::dropIfExists('jadwal_ujians');
    }
}
