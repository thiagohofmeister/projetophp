<?php

namespace forum\Http\Controllers;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
	public function index() 
	{
		$eventos = $this->buscarEventos();
		return view('index', ['eventos' => $eventos]);
	}

	public function login() 
	{
		return view('login');
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