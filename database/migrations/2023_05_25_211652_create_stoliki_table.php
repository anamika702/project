
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
  Schema::dropIfExists('stoliki');
Schema::create('stoliki', function (Blueprint $table) {
$table->increments('ID_stolika');
$table->integer('Numer_stolika');
$table->integer('Ilosc_miejsc');
$table->string('Status_stolika', 20)->default('wolny');
$table->string('Status_rezerwacji', 20)->default('brak');
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('stoliki');
}
};
