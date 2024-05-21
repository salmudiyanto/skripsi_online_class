<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanEssaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_essays', function (Blueprint $table) {
            $table->id();
            $table->char('id_soal', 12);
            $table->char('siswa', 12);
            $table->longText('jawaban');
            $table->float('nilai_jawaban', 16,2);
            // $table->char('nilai_jawaban', 12);
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
        Schema::dropIfExists('jawaban_essays');
    }
}
