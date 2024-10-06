<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRezerwacjeTable extends Migration
{
    public function up()
    {
        Schema::create('rezerwacje', function (Blueprint $table) {
            $table->id('ID_rezerwacji');
            $table->string('Nazwisko');
            $table->string('Numer_tel');
            $table->unsignedInteger('ID_stolika');
            $table->date('Data_rezerwacji');
            $table->time('Godzina_rezerwacji');
            $table->integer('Liczba_osob');
            $table->string('Status_rezerwacji');
            $table->text('Inne_informacje')->nullable();
            $table->timestamps();

            // Dodanie kluczy obcych
            $table->foreign('ID_stolika')->references('ID_stolika')->on('stoliki');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rezerwacje');
    }
}
