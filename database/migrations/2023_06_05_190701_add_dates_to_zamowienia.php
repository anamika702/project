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
        Schema::table('zamowienia', function (Blueprint $table) {
            $table->timestamp('przyjecie_at')->nullable();
            $table->timestamp('zrealizowanie_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zamowienia', function (Blueprint $table) {
            $table->dropColumn('przyjecie_at');
            $table->dropColumn('zrealizowanie_at');
        });
    }
};
