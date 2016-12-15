<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;
use forum\Http\Requests\PalestranteRequest;
use App\Http\Requests;
use forum\Palestrante;
use File;

class PalestranteController extends Controller
{
	private $Palestrante;

	public function __construct(Palestrante $Palestrante)
	{
		$this->Palestrante = $Palestrante;
	}
	
    /**
	 * Tela de Cadastro
	 */
    public function cadastro()
	{
		return view('palestrante/cadastro');
	}

	/**
	 * Realiza o cadastro
	 *
	 * @param PalestranteRequest $request - Retorna a requisição após validar
	 * @return Retorna a view de confirmação
	 */
	public function add(PalestranteRequest $request)
	{
		$req = $request->except('foto', '_token');

		// Upload da Imagem
		$file = $request->file('foto');

		if (!empty($file)) {
			$file_name = $this->makeFileName($file, $req['nome']);
			$file_path = "uploads/palestrante/";

			$this->upload($file, $file_path, $file_name);
			$req['foto'] = $file_path . $file_name;
		}

		$palestrante = new Palestrante($req);
		$palestrante->save();

		return redirect('palestrante/cadastro')->with('msg', 'Palestrante cadastrado com sucesso!');
	}

	public function lista()
	{
		$palestrantes = Palestrante::all();

		return view('palestrante/palestrantes', ['palestrantes' => $palestrantes]);
	}

	public function edit($id)
	{
		$palestrante = $this->Palestrante->find($id);

		return view('palestrante/editar', [
			'palestrante' => $palestrante
		]);
	}

	public function postEdit($id, PalestranteRequest $request)
	{
		$req = $request->except('_token');

		$palestrante = $this->Palestrante->find($id);

		// Upload da Imagem
		$file = $request->file('foto');
		
		if (!empty($file)) {
			$file_name = $this->makeFileName($file, $req['nome']);
			$file_path = "uploads/palestrante/";

			$this->upload($file, $file_path, $file_name);
			$req['foto'] = $file_path . $file_name;

			if ($req['nome'] != $palestrante['nome']) {
				$del = File::delete($palestrante['foto']);
			}
		}

		$update = $palestrante->update($req);

		if ($update) {
			return redirect('palestrante/edit/'.$id)->with('msg', 'Palestrante alterado com sucesso!');
		} else {
			return redirect('palestrante/edit/'.$id)->with('msg', 'Erro ao atualizar o palestrante!');
		}
	}

	public function del($id)
	{
		$delete = $this->Palestrante->find($id)->delete();
		
		if ($delete) {
			return redirect('palestrante/lista')->with('msg', 'Palestrante excluída com sucesso!');
		} else {
			return redirect('palestrante/lista')->with('msg', 'Erro ao excluir o palestrante!');
		}
	}
}
