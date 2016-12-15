<?php

namespace forum\Http\Controllers;

use Illuminate\Http\Request;
use forum\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use forum\Http\Requests\PalestraRequest;
use forum\Palestra;
use forum\PalestrasRecurso;
use forum\Equipe;
use forum\Aluno;
use File;
use Dompdf\Dompdf;

class PalestraController extends Controller
{
	private $Palestra;

	public function __construct(Palestra $Palestra)
	{
		$this->Palestra = $Palestra;
	}
	
    /**
	 * Tela de Cadastro
	 */
    public function cadastro()
	{
		$palestrantes = DB::table('palestrantes')->select('id', 'nome')->get();
		$salas = DB::table('salas')->select('id', 'nome', 'adaptavel')->get();
		$recursos = DB::table('recursos')
			->select('recursos.id', 'nome', 'quantidade')
			//->count('id_recurso')
			->leftJoin('palestras_recursos', 'recursos.id', '=', 'palestras_recursos.id_recurso')
			->selectRaw('count(id_recurso)')
			->groupBy('id_recurso', 'nome', 'recursos.id', 'quantidade')
			->havingRaw('quantidade > count(id_recurso)')
			->get();
		$colaboradores = DB::table('colaboradores')->select('id', 'nome')->where('status', '1')->get();
		$eventos = DB::table('eventos')->select('id', 'nome')->get();

		return view('palestra/cadastro', [
			'palestrantes' => $palestrantes, 
			'salas' => $salas, 
			'recursos' => $recursos, 
			'colaboradores' => $colaboradores,
			'eventos' => $eventos
		]);
	}
	
	/**
	 * Realiza o cadastro
	 *
	 * @param PalestraRequest $request - Retorna a requisição após validar
	 * @return Retorna a view de confirmação
	 */
	public function add(PalestraRequest $request)
	{
		$req = $request->except('foto_capa', '_token', 'recurso', 'equipe');

		$req['slug'] = $this->makeSlug($req['titulo']);
		
		// Puxar os recursos (multiselect)
		$recursos = $request->only('recurso');
		
		// Puxar os colaboradores - equipe (multiselect)
		$colaboradores = $request->only('equipe');

		// Upload da Imagem
		$file = $request->file('foto_capa');
		
		if (!empty($file)) {
			$file_name = $this->makeFileName($file, $req['titulo']);
			$file_path = "uploads/palestra/";

			$this->upload($file, $file_path, $file_name);
			$req['foto_capa'] = $file_path . $file_name;
		}	

		$codigoEvento = str_repeat('0', 4 - strlen($req['id_evento'])) . $req['id_evento'];

		$ultimaPalestra = DB::table('palestras')->where('id_evento', '=', $req['id_evento'])->count();
		$sequencial = 1;
		if (!empty($ultimaPalestra)) {
			$sequencial = $ultimaPalestra + 1;
		}
		$sequencial = str_repeat('0', 4 - strlen($sequencial)) . $sequencial;

		$data = str_replace('-', '', $req['data']);

		$req['codigo'] = $data . $codigoEvento . $sequencial;

		$palestra = new Palestra($req);
		$palestra->setDatas();
		$palestra->save();
		
		// Cadastra os recursos
		if (!empty($recursos['recurso'])) {
			foreach ($recursos['recurso'] as $rec) {
				$dados = ['id_palestra' => $palestra->id, 'id_recurso' => $rec];
				$recurso = new PalestrasRecurso($dados);
				$recurso->save();
			}
		}
		
		// Cadastra a equipe
		if (!empty($colaboradores['equipe'])) {
			foreach ($colaboradores['equipe'] as $col) {
				$dados = ['id_palestra' => $palestra->id, 'id_colaborador' => $col];
				$equipe = new Equipe($dados);
				$equipe->save();
			}
		}

		return redirect('palestra/cadastro')->with('msg', 'Palestra cadastrado com sucesso!');
	}

	public function certificados()
	{
		return view('palestra/certificados');
	}

	public function postCertificados(Request $request)
	{
		$ra = $request->only('ra');

		$palestras = DB::table('palestras')
			->join('alunos_palestras', 'palestras.id', '=', 'alunos_palestras.id_palestra')
			->join('alunos', 'alunos.id', '=', 'alunos_palestras.id_aluno')
			->where('ra', $ra)
			->where('presente', '1')
			->get();

		if (count($palestras) > 0) {
			return view('palestra/certificados', ['palestras' => $palestras]);
		} else {
			return view('palestra/certificados', ['palestras' => $palestras])
				->withErrors(['errors' => "Nenhuma palestra encontrada para esse RA. Tente outro."]);
		}
	}

	public function emitirCertificado($ra, $id_palestra)
	{
		return "Emitir o certificado aqui!";
	}

	public function lista()
	{
		$palestras = DB::table('palestras')
			->join('palestrantes', 'palestras.id_palestrante', '=', 'palestrantes.id')
			->get();

		return view('palestra/palestras', ['palestras' => $palestras]);
	}

	/**
	 * Exibe uma única Palestra
	 *
	 * @param String $slug - Slug da palestra
	 */
	public function single($slug)
	{
		$palestra = $this->Palestra->select('palestras.*', 'eventos.data_insc_inicio', 'eventos.data_insc_fim')->where('palestras.slug', '=', $slug)->join('eventos', 'eventos.id', '=', 'palestras.id_evento')->first();

		return view('palestra/single', ['palestra' => $palestra]);
	}


	public function edit($id)
	{
		$palestra = $this->Palestra->find($id);

		$palestrantes = DB::table('palestrantes')->select('id', 'nome')->get();
		$salas = DB::table('salas')->select('id', 'nome', 'adaptavel')->get();
		$recursos = DB::table('recursos')
			->select('recursos.id', 'nome', 'quantidade')
			//->count('id_recurso')
			->leftJoin('palestras_recursos', 'recursos.id', '=', 'palestras_recursos.id_recurso')
			->selectRaw('count(id_recurso)')
			->groupBy('id_recurso', 'nome', 'recursos.id', 'quantidade')
			->havingRaw('quantidade > count(id_recurso)')
			->get();
		$colaboradores = DB::table('colaboradores')->select('id', 'nome')->get();
		$eventos = DB::table('eventos')->select('id', 'nome')->get();

		return view('palestra/editar', [
			'palestra' => $palestra,
			'palestrantes' => $palestrantes, 
			'salas' => $salas, 
			'recursos' => $recursos, 
			'colaboradores' => $colaboradores,
			'eventos' => $eventos
		]);
	}

	public function postEdit($id, PalestraRequest $request)
	{
		$req = $request->except('_token');

		$palestra = $this->Palestra->find($id);

		$req['slug'] = $this->makeSlug($req['titulo']);

		// Upload da Imagem
		$file = $request->file('foto_capa');
		
		if (!empty($file)) {
			$file_name = $this->makeFileName($file, $req['titulo']);
			$file_path = "uploads/palestra/";

			$this->upload($file, $file_path, $file_name);
			$req['foto_capa'] = $file_path . $file_name;

			if ($req['slug'] != $palestra['slug']) {
				$del = File::delete($palestra['foto_capa']);
			}
		}

		$update = $this->Palestra->find($id)->update($req);

		if ($update) {
			return redirect('palestra/edit/'.$id)->with('msg', 'Palestra alterada com sucesso!');
		} else {
			return redirect('palestra/edit/'.$id)->with('msg', 'Erro ao atualizar a palestra!');
		}
	}

	public function del($id)
	{
		$delete = $this->Palestra->find($id)->delete();
		
		if ($delete) {
			return redirect('palestra/lista')->with('msg', 'Palestra excluída com sucesso!');
		} else {
			return redirect('palestra/lista')->with('msg', 'Erro ao excluir a palestra!');
		}
	}
	
	public function participacao()
	{
		return view('palestra/participacao', ['aluno' => [], 'palestras' => []]);
	}
	
	public function postParticipacao(Request $request)
	{
		$req = $request->except('_token');

		$aluno = Aluno::where('ra', $req['ra'])->first();
		if (!empty($aluno)) {
			//$this->setDatas($aluno, ['data_nascimento'], true);

			$palestras = $this->Palestra->join('alunos_palestras', 'alunos_palestras.id_palestra', '=', 'palestras.id')->get();
			$this->setDatas($palestras, ['data'], true);

			return view('palestra/participacao', [
				'aluno' => $aluno, 
				'palestras' => $palestras
			]);
		} else {
			return view('palestra/participacao', ['aluno' => [], 'palestras' => []])->withErrors(['errors' => "Nenhum aluno encontrado. Tente novamente."]);
		}
	}

	public function certificado($aluno, $palestra)
	{
		$aluno = Aluno::find($aluno);
		$palestra = $this->Palestra->find($palestra)->join('eventos', 'eventos.id', '=', 'palestras.id_evento')->select('palestras.*', 'eventos.nome')->first();

		$this->setDatas($palestra, ['data'], true);
		$palestra->hora = date('H:i', strtotime($palestra->hora));
		$palestra->horaFinal = date('H:i', strtotime($palestra->hora + $palestra->duracao));

		

		$dompdf = new Dompdf();
		$dompdf->loadHtml($this->montarHtmlCertificado($aluno, $palestra));
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->set_option('defaultFont', 'Arial');
		$dompdf->render();
		$dompdf->stream('Certificado de Presenca do aluno ' . $aluno->nome);
	}

	private function montarHtmlCertificado($aluno, $palestra)
	{	
		$html = "
			<div style='font-family: sans-seriff'>
				<div style='text-align: center; position: absolute; top: 80px;'>
					<img src='images/logo.png' alt='Logotipo da QI' width='200px' style='display: block;'>
					<h1 style='text-align: center; font-size: 35px; text-transform: uppercase; margin: 50px 0 30px;'>Certificado</h1>
					<h3 style='text-align: center; font-size: 22px; border-bottom: 1px solid #000; width: 500px; margin: 0 auto; padding-bottom: 10px;'>{$aluno->nome}</h3>
					<p style='text-align: center; font-size: 15px;'>participou da palestra {$palestra->titulo} que estava incluída no evento {$palestra->nome}.</p>
					<p style='text-align: center; font-size: 15px;'>A palestra ocorreu no dia {$palestra->data} das {$palestra->hora} às {$palestra->horaFinal}.</p>
					<p style='text-align: center; font-size: 15px;'>Agradecemos a sua participação no evento.</p>
				</div>

				<div style='position: absolute; bottom: 50px; left: 100px; width: 300px; text-align: center; border-top: 1px solid #000; padding-top: 10px;'>
					<p>Coordenador(a)</p>
				</div>

				<div style='position: absolute; bottom: 50px; right: 100px; width: 300px; text-align: center; border-top: 1px solid #000; padding-top: 10px;'>
					<p>Aluno participante</p>
				</div>
			</div>
		";

		return $html;
	}
}

