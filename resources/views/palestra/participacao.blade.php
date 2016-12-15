@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Participações nas palestras</h1>

	@if (count($errors) > 0)
	  <div class="alert alert-danger">
	    <ul>
	       @foreach ($errors->all() as $error)
	       <li>{{ $error }}</li>
	       @endforeach
	    </ul>
	  </div>
	  @endif

	  @if (session('msg'))
	  <div class="alert alert-success">
	    <ul>      
	       <li>{{ session('msg') }}</li>
	    </ul>
	  </div>
	  @endif
    
    <form id="formExemplo" data-toggle="validator" action="/palestra/participacao" role="form" method="post">
      <div class="form-group">
        <label for="textRaAluno" class="control-label">RA do Aluno</label>
        <input id="textRaAluno" class="form-control" name="ra"  type="text" value="{{old('ra')}}" placeholder="Digite o RA">
      </div>

      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    @if (!empty($aluno))
    <div class="row">
    	<div class="col-md-4">
    		<h4>Aluno encontrado:</h4>
    		<ul>
    			<li>RA: {{ $aluno->ra }}</li>
    			<li>Nome: {{ $aluno->nome }}</li>
    			<li>Data de Nascimento: {{ $aluno->data_nascimento }}</li>
    			@if (auth()->guard('colaborador')->user())
    				<li>E-mail: {{ $aluno->email }}</li>
    				<li>Telefone: {{ $aluno->telefone }}</li>
    			@endif
    		</ul>
    	</div>
    </div>
    @endif
	
	@if (count($palestras) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Título da Palestra</th>
                <th>Data</th>
				<th>Hora Inicial / Final</th>
				<th>Certificado</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($palestras as $p)
			<tr>
				<td>{{ $p->titulo }}</td>
				<td>{{ $p->data }}</td>
                <td>{{ date('H:i', strtotime($p->hora)) . ' / ' . date('H:i', strtotime($p->hora + $p->duracao)) }}</td>
				<td>
					<a href="{{ url('palestra/certificado/' . $aluno->id . '/' . $p->id) }}" class="btn btn-xs btn-info">Emitir</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@stop