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
        Schema::create('szczegoly_zamowien', function (Blueprint $table) {
            $table->id('id_szczegoly');
            $table->unsignedBigInteger('zamowienie_id');
            $table->unsignedBigInteger('menu_id');
            $table->integer('ilosc');
            $table->enum('status', ['gotowe', 'w trakcie przygotowania', 'oczekuje', 'wydane', 'opłacone']);
            $table->timestamps();

            $table->foreign('zamowienie_id')->references('id_zamowienia')->on('zamowienia')->onDelete('cascade');
            $table->foreign('menu_id')->references('id_menu')->on('menu');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('szczegoly_zamowien');
    }
};
