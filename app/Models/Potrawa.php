<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potrawa extends Model
{
    use HasFactory;

    protected $table = 'potrawy';
    protected $primaryKey = 'id_potrawy';

    public $timestamps = false;


    protected $fillable = ['nazwa'];

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id_potrawa');
    }
}
