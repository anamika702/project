<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rachunek extends Model
{
    protected $table = 'rachunek';
    protected $primaryKey = 'id_rachunku';
    public $timestamps = true;

    // Inne właściwości i metody modelu...
}
