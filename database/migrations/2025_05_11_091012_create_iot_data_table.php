<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIotDataTable extends Migration
{
    public function up()
    {
        Schema::create('iot_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('suhu');
            $table->unsignedTinyInteger('kelembapan');
            $table->float('tinggi_air');
            $table->float('persentase_air');
            $table->boolean('lampu_menyala');
            $table->boolean('kipas_menyala');
            $table->boolean('kran_terbuka');
            $table->string('status_air');
            $table->float('status_pakan_ayam');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('iot_data');
    }
}