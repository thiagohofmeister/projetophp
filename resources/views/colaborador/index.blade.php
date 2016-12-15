@extends('layout.principal')

@section('conteudo')
<div class="container">
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
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bem-vindo(a) {{auth()->guard('colaborador')->user()->nome}}</div>

                <div class="panel-body">
                    <a href="{{ url('/colaborador/edit/' . auth()->guard('colaborador')->user()->id) }}">Editar meu perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
