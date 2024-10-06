<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('raport', function (Blueprint $table) {
            $table->increments('id_raportu');
            $table->unsignedBigInteger('id_pracownika');
            $table->date('data_raportu');
            $table->decimal('dochod', 8, 2);
            $table->timestamps();

            $table->foreign('id_pracownika')->references('id')->on('pracownik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raport');
    }
};
