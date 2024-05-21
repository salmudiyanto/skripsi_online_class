<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerjakanSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerjakan_soals', function (Blueprint $table) {
            $table->id();
            $table->char('siswa', 20);
            $table->char('id_ujian', 20);
            $table->char('id_soal', 20); 
            $table->char('jawaban', 2); 
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
        Schema::dropIfExists('kerjakan_soals');
    }
}
