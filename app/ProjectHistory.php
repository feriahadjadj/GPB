<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectHistory extends Model
{
    protected $table = 'project_histories';

    protected $fillable = [
        'projet_id',
        'user_id',
        'action',
        'field',
        'old_value',
        'new_value',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'projet_id');
    }
}
