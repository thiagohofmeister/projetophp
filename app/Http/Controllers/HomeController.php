<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Evento;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = $this->buscarEventos();
        return view('home', ['eventos' => $eventos]);
    }
    
    private function buscarEventos()
	{
		$dataAtual = date('Y-m-d H:i:s');
		$eventos = DB::table('eventos')
			->where([ ['data_insc_inicio', '<=', $dataAtual], ['data_insc_fim', '>=', $dataAtual] ])
			->orWhere([ ['data_rea_inicio', '<=', $dataAtual], ['data_rea_fim', '>=', $dataAtual] ])
			->orWhere([ ['data_exi_inicio', '<=', $dataAtual], ['data_exi_fim', '>=', $dataAtual] ])
			->where('status', '1')
			->get();

		foreach ($eventos as $e) {
			$this->setDatas($e, ['data_insc_inicio', 'data_insc_fim', 'data_rea_inicio', 'data_rea_fim'], true);
		}

		return $eventos;
	}
}
