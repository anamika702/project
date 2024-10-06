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
        Schema::create('rachunek', function (Blueprint $table) {
            $table->increments('id_rachunku');
            $table->unsignedBigInteger('zamowienie_id');
            $table->decimal('cena_rachunku', 8, 2);
            $table->timestamps();

            $table->foreign('zamowienie_id')->references('id_zamowienia')->on('zamowienia')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rachunek');
    }
};
