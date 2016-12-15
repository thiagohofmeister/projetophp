<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use forum\Http\Requests\AlunosPalestraRequest;
use forum\AlunosPalestra;
use forum\Aluno;
use forum\Palestra;

class AlunosPalestraController extends Controller
{
	private $AlunosPalestra;
	private $Palestra;

	public function __construct(AlunosPalestra $AlunosPalestra, Aluno $Aluno, Palestra $Palestra)
	{
		$this->AlunosPalestra = $AlunosPalestra;
		$this->Aluno = $Aluno;
		$this->Palestra = $Palestra;
	}
	
    /**
	 * Tela de Cadastro
	 */
    public function cadastro()
	{
		return view('presenca/cadastro');
	}

	public function participar($slug)
	{
		$palestra = $this->Palestra->select('codigo')->where('slug', $slug)->first();
		return view('aluno/palestra', ['codigo' => $palestra->codigo]);
	}

	/**
	 * Tela de Presenca
	 */
	public function palestra()
	{
		return view('aluno/palestra');
	}
	
	/**
	 * Realiza o cadastro
	 *
	 * @param EventoRequest $request - Retorna a requisição após validar
	 * @return Retorna a view de confirmação
	 */
	public function add(AlunosPalestraRequest $request)
	{
		$req = $request->except('_token');

		$palestra = $this->Palestra->select('id')->where('codigo', $req['codigo_palestra'])->first();
		$aluno = $this->Aluno->select('id')->where('ra', $req['ra'])->first();

		$req = ['id_palestra' => $palestra->id, 'id_aluno' => $aluno->id];

		$validator = $this->AlunosPalestra->where('id_aluno', $aluno->id)->where('id_palestra', $palestra->id)->count();

		if ($validator > 0) {
			return redirect('aluno/palestra')
                        ->withErrors(['errors' => 'Este aluno já está cadastrado nesta palestra.'])
                        ->withInput();
		}

		$alunosPalestra = new AlunosPalestra($req);
		$alunosPalestra->save();

		return redirect('aluno/palestra')->with('success', $aluno->id);
	}

	/**
	 * Marcar a presença do aluno na palestra
	 *
	 * @param EventoRequest $request - Retorna a requisição após validar
	 * @return Retorna a view de confirmação
	 */
	public function marcarPresenca(AlunosPalestraRequest $request)
	{
		$req = $request->except('_token');

		$palestra = $this->Palestra->select('id')->where('codigo', $req['codigo_palestra'])->first();
		$aluno = $this->Aluno->select('id')->where('ra', $req['ra'])->first();

		$req = ['id_palestra' => $palestra->id, 'id_aluno' => $aluno->id];

		$result = $this->AlunosPalestra->where('id_aluno', $aluno->id)->where('id_palestra', $palestra->id)->first();

		if (count($result) > 0) {
			if ($result->presente == '1') {
				return redirect('presenca/cadastro')
                        ->withErrors(['errors' => 'Este aluno já está com presença nessa palestra.'])
                        ->withInput();
			} else {
				$result->update(['presente' => '1']);

				return redirect('presenca/cadastro')
                        ->with(['msg' => 'O aluno ganhou presença na palestra'])
                        ->withInput();
			}
		} else {
			return redirect('presenca/cadastro')
                        ->withErrors(['errors' => 'Este aluno não está nesta palestra'])
                        ->withInput();
		}
		
	}

	public function lista()
	{

		$presencas = DB::table('alunos_palestras')
			->select(DB::raw('count(alunos_palestras.id_aluno) as quantidade'), 'titulo', 'nome as evento')
				->join('palestras', 'palestras.id', '=', 'alunos_palestras.id_palestra')
				->join('eventos', 'palestras.id_evento', '=', 'eventos.id')			
				->where('presente', '1')
				->groupBy('alunos_palestras.id_palestra')
				->get();

		return view('presenca/presencas', ['presencas' => $presencas]);
	}
}
