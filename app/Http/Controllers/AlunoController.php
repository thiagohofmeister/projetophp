<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;
use forum\Http\Requests\AlunoRequest;
use Illuminate\Support\Facades\DB;
use forum\Aluno;
use forum\AlunosPalestra;
use forum\Palestra;
use Auth;

class AlunoController extends Controller
{
	private $Aluno;

	public function __construct(Aluno $Aluno)
	{
		$this->Aluno = $Aluno;
	}
	
    /**
	 * Tela de Cadastro
	 */
    public function cadastro()
	{
		return view('aluno/cadastro');
	}

	/**
	 * Realiza o cadastro
	 *
	 * @param ColaboradorRequest $request - Retorna a requisição após validar
	 * @return Retorna a view de confirmação
	 */
	public function add(AlunoRequest $request)
	{
		$req = $request->except('_token');

		$aluno = new Aluno($req);
		$aluno->setDatas();
		$aluno->save();

		return redirect('aluno/cadastro')->with('msg', 'Aluno cadastrado com sucesso!');
	}

	public function index()
	{
		$aluno = auth()->guard('aluno')->user()->id;
		$palestras = Palestra::join('alunos_palestras', 'alunos_palestras.id_palestra', 'palestras.id')
				->where('id_aluno', $aluno)
				->where('presente', '1')
				->orderBy('data', 'asc')
				->get();

		$palestras_novas = Palestra::join('alunos_palestras', 'alunos_palestras.id_palestra', 'palestras.id')
			->where('id_aluno', $aluno)
			->where('presente', '0')
			->orderBy('data', 'asc')
			->get();

		return view('aluno/index', ['palestras' => $palestras, 'palestras_novas' => $palestras_novas]);
	}

	public function login()
	{
		return view('aluno/login');
	}

	public function postLogin(Request $request)
	{
		$credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
		if (auth()->guard('aluno')->attempt($credentials)) {
			return redirect('/aluno');
		} else {
			return redirect('/aluno/login')->withErrors([
				'errors' => 'O e-mail ou a senha estão inválidos. Tente novamente.'
			]);
		}
	}

	public function lista()
	{
		$alunos = DB::table('alunos')
			->get();;

		return view('aluno/alunos', ['alunos' => $alunos]);
	}

	public function logout()
	{
		auth()->guard('aluno')->logout();

		return redirect('/');
	}

	public function edit($id)
	{
		$aluno = $this->Aluno->find($id);

		return view('aluno/editar', [
			'aluno' => $aluno
		]);
	}

	public function postEdit($id, Request $request)
	{
		$req = $request->except('_token');
		
		$opts = [
			'ra' => 'required',
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'data_nascimento' => 'required',
			'password' => 'required|min:6',
			'password_confirmation' => 'required|same:password'
		];
		
		$msg = [
			'same' => 'Os campos senha e confirmação de senha devem ser iguais',
			'password_confirmation.required' => 'O campo de confirmação de senha é obrigatório.'
		];
		
		if (empty($req['password'])) {
			unset($req['password'], $req['password_confirmation']);
			unset($opts['password'], $opts['password_confirmation']);
		}
		
		$validator = validator($req, $opts, $msg);
		
		if ($validator->fails()) {
			return redirect('aluno/edit/'.$id)->withErrors($validator)->withInput();
		}

		$aluno = $this->Aluno->find($id);

		

		$update = $aluno->update($req);

		if ($update) {
			return redirect('aluno/edit/'.$id)->with('msg', 'Aluno alterado com sucesso!');
		} else {
			return redirect('aluno/edit/'.$id)->with('msg', 'Erro ao atualizar o aluno!');
		}
	}

	public function del($id)
	{
		$delete = $this->Aluno->find($id)->delete();
		
		if ($delete) {
			return redirect('aluno/lista')->with('msg', 'Aluno excluída com sucesso!');
		} else {
			return redirect('aluno/lista')->with('msg', 'Erro ao excluir o aluno!');
		}
	}

	public function perfil($id)
	{
		$aluno = $this->Aluno->find($id);

		if (count($aluno) > 0) {
			$aluno = $aluno->first();

			$palestras = Palestra::join('alunos_palestras', 'alunos_palestras.id_palestra', 'palestras.id')
				->where('id_aluno', $aluno->id)
				->where('presente', '1')
				->orderBy('data', 'asc')
				->get();

			$palestras_novas = Palestra::join('alunos_palestras', 'alunos_palestras.id_palestra', 'palestras.id')
				->where('id_aluno', $aluno->id)
				->where('presente', '0')
				->orderBy('data', 'asc')
				->get();
				
			return view('aluno/perfil', ['aluno' => $aluno, 'palestras' => $palestras, 'palestras_novas' => $palestras_novas]);
		} else {
			return redirect('/');
		}
	}
}
