<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grafik extends Model
{
    protected $table = 'grafik';
    protected $primaryKey ='id_grafika';
    protected $fillable = [
        'id_grafika',
        'id_pracownika',
        'id_stolika',
        'data',
        'nr_zmiany',
    ];

    /**
     * Get the assigned Pracownik for the Grafik.
     */
    public function pracownik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pracownika');
    }

    public function stolik()
    {
        return $this->belongsTo(Stolik::class, 'id_stolika');
    }
}
