<?php

namespace forum;

use Illuminate\Database\Eloquent\Model;

class Palestra extends Model
{
     protected $fillable = [
        'codigo',
    	'titulo',
        'slug',
    	'data', 
    	'hora',
        'duracao',
        'descricao',
        'conteudos',
        'id_palestrante',
        'id_sala',
        'id_evento',
        'foto_capa'
    ];
    public $timestamps = false;
    
    public $dates_as = [
    	'data'
    ];

  	public function setDatas()
    {
        foreach ($this->dates_as as $key => $date) {
            $this->$date = $this->arrumarDatas($this->$date);
        }
    }

    private function arrumarDatas($data) {
        return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data)));
    }
    
    public function sala()
    {
        return $this->hasOne('forum\Sala');
    }
    
    public function palestrante()
    {
        return $this->hasOne('forum\Palestrante');
    }

    public function alunos()
    {
        return $this->hasMany('forum\Aluno');
    }    
}
