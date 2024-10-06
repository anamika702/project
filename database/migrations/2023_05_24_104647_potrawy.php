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
        Schema::create('potrawy', function (Blueprint $table) {
            $table->increments('id_potrawy');
            $table->string('nazwa');
            $table->text('opis')->nullable();
            $table->string('kategoria');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potrawy');
    }
};
