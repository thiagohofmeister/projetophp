@extends('layout/principal')

@section('conteudo')
<div class="container">
    <h1>Login</h1>
    <p>Você tentou acessar uma página que necessita de permissão.</p>
    <p>Por favor, clique no botão que define sua função.</p>

    <a href="{{ url('/aluno/login') }}" class="btn btn-lg btn-info">Aluno</a>
    <a href="{{ url('/colaborador/login') }}" class="btn btn-lg btn-info">Colaborador</a>
</div>
@stop