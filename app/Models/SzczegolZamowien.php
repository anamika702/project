<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SzczegolZamowien extends Model
{
    use HasFactory;

    protected $table = 'szczegoly_zamowien';
    protected $primaryKey = 'id_szczegoly';
    protected $fillable = ['zamowienie_id', 'menu_id', 'ilosc', 'status'];

    public function zamowienie()
    {
        return $this->belongsTo(Zamowienie::class, 'zamowienie_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
