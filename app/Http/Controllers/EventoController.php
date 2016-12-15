<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;
use forum\Http\Requests\EventoRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use forum\Evento;
use forum\Palestra;
use File;

class EventoController extends Controller
{
	private $Evento;

	public function __construct(Evento $Evento)
	{
		$this->Evento = $Evento;
	}
	
    /**
	 * Tela de Cadastro
	 */
    public function cadastro()
	{
		return view('evento/cadastro');
	}

	/**
	 * Realiza o cadastro
	 *
	 * @param EventoRequest $request - Retorna a requisição após validar
	 * @return Retorna a view de confirmação
	 */
	public function add(EventoRequest $request)
	{
		$req = $request->except('foto_capa', '_token');

		$req['slug'] = $this->makeSlug($req['nome']);

		// Upload da Imagem
		$file = $request->file('foto_capa');
		
		if (!empty($file)) {
			$file_name = $this->makeFileName($file, $req['nome']);
			$file_path = "uploads/evento/";

			$this->upload($file, $file_path, $file_name);
			$req['foto_capa'] = $file_path . $file_name;
		}

		$evento = new Evento($req);
		$evento->setDatas();
		$evento->save();

		return redirect('evento/cadastro')->with('msg', 'Evento cadastrado com sucesso!');
	}

	/**
	 * Exibe todos os eventos
	 *
	 * 
	 */
	public function lists()
	{
		$eventos = $this->buscarEventos();

		return view('evento/list', ['eventos' => $eventos]);
	}

	public function lista()
	{
		$eventos = $this->buscarEventos();

		return view('evento/eventos', ['eventos' => $eventos]);
	}

	/**
	 * Exibe um único Evento
	 *
	 * @param String $slug - Slug do evento
	 */
	public function single($slug)
	{
		$evento = $this->Evento->where('slug', $slug)->first();
		$palestras = Palestra::where('id_evento', $evento->id)
			->join('palestrantes', 'palestras.id_palestrante', '=', 'palestrantes.id')
			->get();
			
		$this->setDatas($palestras, ['data'], true);

		return view('evento/single', ['evento' => $evento, 'palestras' => $palestras]);
	}

	public function edit($id)
	{
		$evento = $this->Evento->find($id);

		$this->setDatas($evento, [
	    	'data_insc_inicio', 
	    	'data_insc_fim', 
	    	'data_rea_inicio', 
	    	'data_rea_fim', 
	    	'data_exi_inicio', 
	    	'data_exi_fim'
	    ]);

		return view('evento/editar', [
			'evento' => $evento
		]);
	}

	public function postEdit($id, EventoRequest $request)
	{
		$req = $request->except('_token');

		$evento = $this->Evento->find($id);

		$req['slug'] = $this->makeSlug($req['nome']);

		// Upload da Imagem
		$file = $request->file('foto_capa');
		
		if (!empty($file)) {
			$file_name = $this->makeFileName($file, $req['nome']);
			$file_path = "uploads/evento/";

			$this->upload($file, $file_path, $file_name);
			$req['foto_capa'] = $file_path . $file_name;

			if ($req['slug'] != $evento['slug']) {
				$del = File::delete($evento['foto_capa']);
			}
		}

		$this->setDatas($req, [
	    	'data_insc_inicio', 
	    	'data_insc_fim', 
	    	'data_rea_inicio', 
	    	'data_rea_fim', 
	    	'data_exi_inicio', 
	    	'data_exi_fim'
	    ]);

		$update = $evento->update($req);

		if ($update) {
			return redirect('evento/edit/'.$id)->with('msg', 'Evento alterado com sucesso!');
		} else {
			return redirect('evento/edit/'.$id)->with('msg', 'Erro ao atualizar o evento!');
		}
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

	public function del($id)
	{
		$delete = $this->Evento->find($id)->delete();
		
		if ($delete) {
			return redirect('evento/lista')->with('msg', 'Evento excluída com sucesso!');
		} else {
			return redirect('evento/lista')->with('msg', 'Erro ao excluir a evento!');
		}
	}
}
