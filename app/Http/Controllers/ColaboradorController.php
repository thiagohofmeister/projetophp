<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;
use forum\Http\Requests\ColaboradorRequest;
use forum\Colaborador;
use Illuminate\Support\Facades\DB;
use Auth;

class ColaboradorController extends Controller
{
	private $Colaborador;

	public function __construct(Colaborador $Colaborador)
	{
		$this->Colaborador = $Colaborador;
	}
	
    /**
	 * Tela de Cadastro
	 */
    public function cadastro()
	{
		return view('colaborador/cadastro');
	}

	public function index()
	{

		return view('colaborador/index');
	}

	public function login()
	{
		return view('colaborador/login');
	}

	public function postLogin(Request $request)
	{
		$credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
		
		if (auth()->guard('colaborador')->attempt($credentials)) {
			if (auth()->guard('colaborador')->user()->status == '1') {
				return redirect('/colaborador');
			} else {
				auth()->guard('colaborador')->logout();

				return redirect('/colaborador/login')->withErrors([
					'errors' => 'Login desativado! Contate algum administrador para verificar o motivo.'
				]);
			}
		} else {
			return redirect('/colaborador/login')->withErrors([
				'errors' => 'O e-mail ou a senha estão inválidos. Tente novamente.'
			])->withInput();
		}
	}

	public function logout()
	{
		auth()->guard('colaborador')->logout();

		return redirect('/');
	}
	
	/**
	 * Realiza o cadastro
	 *
	 * @param ColaboradorRequest $request - Retorna a requisição após validar
	 * @return Retorna a view de confirmação
	 */
	public function add(ColaboradorRequest $request)
	{
		$req = $request->except('_token');

		$colaborador = new Colaborador($req);
		$colaborador->setDatas();
		$colaborador->save();

		return redirect('colaborador/cadastro')->with('msg', 'Colaborador cadastrado com sucesso!');
	}

	public function edit($id)
	{
		if (auth()->guard('colaborador')->user()->id != $id) {
			return redirect('/colaborador')->withErrors(['errors' => 'Você só pode editar seu próprio perfil']);
		}
		$colaborador = $this->Colaborador->find($id);

		return view('colaborador/editar', [
			'colaborador' => $colaborador
		]);
	}

	public function postEdit($id, Request $request)
	{
		$req = $request->except('_token');
		
		$opts = [
			'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'data_nascimento' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password'
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
			return redirect('colaborador/edit/'.$id)->withErrors($validator)->withInput();
		}

		$colaborador = $this->Colaborador->find($id);

		if (empty($req['password'])) {
			unset($req['password']);
		}

		$update = $colaborador->update($req);

		if ($update) {
			return redirect('colaborador/edit/'.$id)->with('msg', 'Colaborador alterado com sucesso!');
		} else {
			return redirect('colaborador/edit/'.$id)->with('msg', 'Erro ao atualizar o colaborador!');
		}
	}

	public function lista()
	{
		$colaboradores = DB::table('colaboradores')
			->get();;

		return view('colaborador/colaboradores', ['colaboradores' => $colaboradores]);
	}

}
