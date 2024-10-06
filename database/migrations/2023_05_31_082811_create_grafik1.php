<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('grafik');

        Schema::create('grafik', function (Blueprint $table) {
            $table->increments('id_grafika');
            $table->unsignedBigInteger('id_pracownika');
            $table->unsignedInteger('id_stolika1')->nullable();
            $table->unsignedInteger('id_stolika2')->nullable();
            $table->unsignedInteger('id_stolika3')->nullable();
            $table->date('data');
            $table->enum('nr_zmiany', ['1', '2'])->default('1');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('id_pracownika')->references('id')->on('pracownik');
            $table->foreign('id_stolika1')->references('ID_stolika')->on('stoliki');
            $table->foreign('id_stolika2')->references('ID_stolika')->on('stoliki');
            $table->foreign('id_stolika3')->references('ID_stolika')->on('stoliki');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grafik');
    }
};
