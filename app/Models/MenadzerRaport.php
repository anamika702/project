<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenadzerRaport extends Model
{
    use HasFactory;

    protected $table = 'menadzer_raport';
    protected $primaryKey = 'id_raportu';
    protected $fillable = ['id_raportu', 'id_pracownika', 'data_raportu', 'dochod'];

    // Pozostałe relacje, metody itd.
}
