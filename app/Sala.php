<?php

namespace forum;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = ['nome', 'capacidade', 'adaptavel'];
    public $timestamps = false;
}
