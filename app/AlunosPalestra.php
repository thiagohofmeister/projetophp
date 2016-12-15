<?php

namespace forum;

use Illuminate\Database\Eloquent\Model;

class AlunosPalestra extends Model
{
    protected $fillable = [
    	'id_aluno', 
    	'id_palestra', 
    	'presente'
    ];
    public $timestamps = false;

    public function aluno()
    {
    	return $this->belongsToMany('forum\Aluno');
    }

    public function palestras()
    {
    	return $this->hasMany('forum\Palestra', 'id');
    }
}
