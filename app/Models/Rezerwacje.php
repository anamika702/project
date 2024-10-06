<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rezerwacje extends Model
{
    protected $table = 'rezerwacje';
    protected $primaryKey = 'ID_rezerwacji';
    protected $fillable = [
        'Nazwisko',
        'Numer_tel',
        'ID_stolika',
        'Data_rezerwacji',
        'Godzina_rezerwacji',
        'Liczba_osob',
        'Status_rezerwacji',
        'Inne_informacje',
    ];


}
