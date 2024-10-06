<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zamowienie extends Model
{
    use HasFactory;
    protected $table = 'zamowienia';
    protected $primaryKey = 'id_zamowienia';
    public $incrementing = true;

    protected $fillable = ['pracownik_id', 'stolik_id', 'przyjecie_at', 'zrealizowanie_at'];

    public function pracownik()
    {
        return $this->belongsTo(User::class, 'pracownik_id', 'id');
    }

    public function stolik()
    {
        return $this->belongsTo(Stolik::class, 'stolik_id');
    }

    public function szczegoly()
    {
        return $this->hasMany(SzczegolZamowien::class, 'zamowienie_id', 'id_zamowienia');
    }

    protected static function booted()
    {
        static::creating(function ($zamowienie) {
            $zamowienie->przyjecie_at = now();
        });
    }

    public function getStatusAttribute()
    {
        $statuses = $this->szczegoly->pluck('status');

        if ($statuses->every(fn ($status) => $status === 'opłacone')) {
            return 'opłacone';
        } elseif ($statuses->every(fn ($status) => $status === 'wydane z kuchni')) {
            if ($this->zrealizowanie_at === null) {
                $this->update(['zrealizowanie_at' => now()]);
            }
            return 'zrealizowane';
        } elseif ($statuses->contains('w trakcie przygotowania') || $statuses->contains('gotowe') || $statuses->contains('wydane')) {
            return 'w trakcie przygotowania';
        } elseif ($statuses->every(fn ($status) => $status === 'oczekuje')) {
            return 'przyjęte';
        }

        return 'nieznany';
    }
}
