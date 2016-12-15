<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;
use forum\Http\Requests\RecursoRequest;
use forum\Recurso;

class RecursoController extends Controller
{
	private $Recurso;

	public function __construct(Recurso $Recurso)
	{
		$this->Recurso = $Recurso;
	}

    /**
	 * Tela de Cadastro
	 */
    public function cadastro()
	{
		return view('recurso/cadastro');
	}
	
	/**
	 * Realiza o cadastro
	 *
	 * @param RecursoRequest $request - Retorna a requisição após validar
	 * @return Retorna a view de confirmação
	 */
	public function add(RecursoRequest $request)
	{
		$req = $request->except('_token');
		$Recurso = new Recurso($req);
		$Recurso->save();

		return redirect('recurso/cadastro')->with('msg', 'Recurso cadastrado com sucesso!');
	}

	public function lista()
	{
		$recursos = Recurso::all();

		return view('recurso/recursos', ['recursos' => $recursos]);
	}

	public function edit($id)
	{
		$recurso = $this->Recurso->find($id);

		return view('recurso/editar', ['recurso' => $recurso]);
	}

	public function postEdit($id, RecursoRequest $request)
	{
		$req = $request->except('_token');
		$update = $this->Recurso->find($id)->update($req);

		if ($update) {
			return redirect('recurso/edit/'.$id)->with('msg', 'Recurso alterado com sucesso!');
		} else {
			return redirect('recurso/edit/'.$id)->with('msg', 'Erro ao atualizar o recurso!');
		}
	}

	public function del($id)
	{
		$delete = $this->Recurso->find($id)->delete();
		
		if ($delete) {
			return redirect('recurso/lista')->with('msg', 'Recurso excluída com sucesso!');
		} else {
			return redirect('recurso/lista')->with('msg', 'Erro ao excluir o recurso!');
		}
	}
}
