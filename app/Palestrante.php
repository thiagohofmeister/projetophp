<?php

namespace forum;

use Illuminate\Database\Eloquent\Model;

class Palestrante extends Model
{
    protected $fillable = [
    	'nome', 
    	'curriculo', 
    	'foto'
    ];
    public $timestamps = false;
}
