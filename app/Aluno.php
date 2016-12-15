<?php

namespace forum;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Aluno extends Authenticatable
{
    protected $fillable = [
    	'ra',
    	'nome', 
    	'email', 
    	'telefone', 
    	'data_nascimento', 
    	'password'
    ];
    public $timestamps = false;
    
    public $dates_as = [
    	'data_nascimento'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function setDatas()
    {
    	if (!empty($this->password)) {
    	   $this->password = Hash::make($this->password);
        }

        foreach ($this->dates_as as $key => $date) {
            $this->$date = $this->arrumarDatas($this->$date);
        }
    }

    private function arrumarDatas($data) {
        return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data)));
    }

    public function alunos_palestras()
    {
        return $this->hasMany('forum\AlunosPalestra', 'id_aluno');
    }
}
