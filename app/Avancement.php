<?php

namespace App;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use App\Projet;

class Avancement extends Model
{

    protected $fillable = [
        'projet_id',
        'montantAlloue',
        'montantEC',
        'montantPC',
        'delaiR',
        'etatPhysique',
        'tauxA',
        'observation'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    function projet()
    {
        return $this->belongsTo('App\Projet');
    }
}
