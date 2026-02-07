<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retard extends Model
{
    protected $fillable = [
        'projet_id',
        'type',
        'date_arret',
        'date_reprise',
        'reason',
        'attachment'   // ✅ REQUIRED
    ];

    public function projet()
    {
        return $this->belongsTo('App\Projet');
    }
}
