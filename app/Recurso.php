<?php

namespace forum;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = ['nome', 'quantidade'];
    public $timestamps = false;
}
