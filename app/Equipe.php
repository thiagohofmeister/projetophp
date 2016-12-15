<?php

namespace forum;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = [
    	'id_palestra', 
    	'id_colaborador'
    ];
    public $timestamps = false;
}
