<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nature extends Model
{
    //
    protected $fillable = ['name'];

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }
}
