@extends('layout/principal')

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
<div class="container">
  <h1>Cadastro de Aluno</h1>
    <form id="formExemplo" data-toggle="validator" action="/aluno/add" role="form" method="post">
  <div class="form-group">
    <label for="textRa" class="control-label">Ra</label>
    <input id="textRa" class="form-control" name="ra" placeholder="Digite o ra" type="text" value="{{old('ra')}}">
  </div>

  <div class="form-group">
    <label for="textNome" class="control-label">Nome</label>
    <input id="textNome" class="form-control" name="nome" placeholder="Digite o Nome do Aluno" type="text" value="{{old('nome')}}">
  </div>

  <div class="form-group">
    <label for="textEmail" class="control-label">E-mail</label>
    <input id="textEmail" class="form-control" name="email" placeholder="Digite o E-mail" type="email" value="{{old('email')}}">
  </div>
  
  <div class="form-group">
    <label for="textTelefone" class="control-label">Telefone</label>
    <input id="textTelefone" class="form-control mask-phone-number" name="telefone" placeholder="Digite o Telefone" type="phone" value="{{old('telefone')}}">
  </div>

  <div class="form-group">
    <label for="textDataNas" class="control-label">Data de Nascimento</label>
    <input id="textSenha" class="form-control" name="data_nascimento" placeholder="Digite a Data de Nascimento" type="date" value="{{old('data_nascimento')}}">
  </div>

  
  <div class="form-group">
    <label for="textSenha" class="control-label">Senha</label>
    <input id="textSenha" class="form-control" name="password" placeholder="Digite a senha" type="password" value="{{old('password')}}">
  </div>
  
  <div class="form-group">
    <label for="textSenha" class="control-label">Confirmar Senha</label>
    <input id="textSenha" class="form-control" name="password_confirmation" placeholder="Digite a senha" type="password" value="{{old('password_confirmation')}}">
  </div>
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
@stop