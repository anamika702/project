<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelnerRaport extends Model
{
    use HasFactory;

    protected $table = 'raport';
    protected $primaryKey = 'id_raportu';

    protected $fillable = [
        'id_raportu',
        'id_pracownika',
        'data_raportu',
        'dochod',
    ];

    public function pracownik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
