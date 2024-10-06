<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'id_menu';

    protected $fillable = ['id_potrawa', 'cena', 'dostepnosc'];
    public function potrawa()
    {
        return $this->belongsTo(Potrawa::class, 'id_potrawa');
    }

    public function szczegoly_zamowienia()
    {
        return $this->hasMany(SzczegolZamowienia::class, 'menu_id');
    }
}
