<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelnerWidok extends Model
{
    protected $fillable = ['kelner_id', 'stolik_id'];

    public function kelner()
    {
        return $this->belongsTo(User::class);
    }

    public function stolik()
    {
        return $this->belongsTo(Stolik::class);
    }
}
