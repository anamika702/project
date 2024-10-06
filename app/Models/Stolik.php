<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stolik extends Model
{
    use HasFactory;
    protected $table = 'stoliki';
    protected $primaryKey = 'ID_stolika'; // Klucz główny

    protected $fillable = [
        'Numer_stolika',
        'Ilosc_miejsc',
        'Status_stolika',
    ];

    public function grafik()
    {
        return $this->belongsTo(Grafik::class, 'id_stolika');
    }


}
