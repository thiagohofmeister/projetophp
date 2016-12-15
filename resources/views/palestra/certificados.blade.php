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
  <h1>Emissão de Certificados</h1>
  <form action="/palestra/certificados" method="post">
    <div class="form-group">
      <input type="text" name="ra" class="form-control" placeholder="Digite o RA">
    </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
  </form>

  @if (count($palestras) > 0)
    <div class="row">
      @foreach ($palestras as $palestra)
        <div class="col-md-4">
          <?php 
            var_dump($palestra);
          ?>
          {{ $palestra->titulo }}
        </div>
      @endforeach
    </div>
  @endif
</div>
@stop