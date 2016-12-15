<?php

namespace forum;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
    	'nome',
        'slug',
    	'descricao', 
    	'data_insc_inicio', 
    	'data_insc_fim', 
    	'data_rea_inicio', 
    	'data_rea_fim', 
    	'data_exi_inicio', 
    	'data_exi_fim', 
    	'foto_capa', 
    	'status'
    ];
    public $timestamps = false;

    public $dates_as = [
    	'data_insc_inicio', 
    	'data_insc_fim', 
    	'data_rea_inicio', 
    	'data_rea_fim', 
    	'data_exi_inicio', 
    	'data_exi_fim'
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
}
