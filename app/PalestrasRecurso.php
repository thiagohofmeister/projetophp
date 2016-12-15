<?php

namespace forum;

use Illuminate\Database\Eloquent\Model;

class PalestrasRecurso extends Model
{
    protected $fillable = [
        'id_palestra',
        'id_recurso'        
    ];
    public $timestamps = false;
}
