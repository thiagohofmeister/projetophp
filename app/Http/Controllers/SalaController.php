<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;
use forum\Http\Requests\SalaRequest;
use forum\Sala;

class SalaController extends Controller
{
	private $Sala;

	public function __construct(Sala $Sala)
	{
		$this->Sala = $Sala;
	}

	/**
	 * Tela de Cadastro
	 */
    public function cadastro() 
	{
		return view('sala/cadastro');
	}

	/**
	 * Realiza o cadastro
	 *
	 * @param SalaRequest $request - Retorna a requisição após validar
	 * @return Retorna a view de confirmação
	 */
	public function add(SalaRequest $request)
	{
		$req = $request->except('_token');
		$Sala = new Sala($req);
		$Sala->save();

		return redirect('sala/cadastro')->with('msg', 'Sala cadastrada com sucesso!');
	}
	
	public function bloco()
	{
		$salas = Sala::all();
		
		return $salas;
	}

	public function lista() 
	{
		$salas = Sala::all();

		return view('sala/salas', ['salas' => $salas]);
	}

	public function edit($id)
	{
		$sala = $this->Sala->find($id);

		return view('sala/editar', ['sala' => $sala]);
	}

	public function postEdit($id, SalaRequest $request)
	{
		$req = $request->except('_token');
		$update = $this->Sala->find($id)->update($req);

		if ($update) {
			return redirect('sala/edit/'.$id)->with('msg', 'Sala alterada com sucesso!');
		} else {
			return redirect('sala/edit/'.$id)->with('msg', 'Erro ao atualizar a sala!');
		}
	}

	public function del($id)
	{
		$delete = $this->Sala->find($id)->delete();
		
		if ($delete) {
			return redirect('sala/lista')->with('msg', 'Sala excluída com sucesso!');
		} else {
			return redirect('sala/lista')->with('msg', 'Erro ao excluir a sala!');
		}
	}
	
	/*public function do_register(UsuarioRequest $request)
	{	
		$req = $request->except('_token', 'cadUsuario');

		Usuario::create($req);
		
		return view('usuario/confirmacao_cadastro', ['nome' => $req['nome']]);
	}

	public function remover($id)
	{
		$usu = Usuario::find($id);
		$usu->delete();
	}*/
}
