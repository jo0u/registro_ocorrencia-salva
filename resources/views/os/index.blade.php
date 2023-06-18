@extends('layouts.app')
@section('title','Painel de Requerentes')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container">
  
  <h1>Ocorrências Reportadas</h1>



  <hr>

  <form action="{{ route('os.index') }}" method="GET" id="filtro-form">
      <div class="row">
          <div class="col-sm-4">
              <div class="form-group">
                  <label for="start_date">Data de inicio</label>
                  <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $startDate) }}">
              </div>
          </div>
          <div class="col-sm-4">
              <div class="form-group">
                  <label for="end_date">Data de Fim</label>
                  <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $endDate) }}">
              </div>
          </div>
          <div class="col-sm-4">
              <div class="form-group">
                  <label>&nbsp;</label>
                  <button type="submit" class="btn btn-primary btn-block">Filtro</button>
              </div>
          </div>
      </div>
  </form>

  <div class="row mt-4">
      <div class="col-sm-4">
          <div class="card">
              <div class="card-header">
                  <h4>Óbitos</h4>
              </div>
              <div class="card-body">
                  <h1>{{ $obitos }}</h1>
              </div>
          </div>
      </div>
      <div class="col-sm-4">
          <div class="card">
              <div class="card-header">
                  <h4>Prevenções</h4>
              </div>
              <div class="card-body">
                  <h1>{{ $prevencoes }}</h1>
              </div>
          </div>
      </div>
      <div class="col-sm-4">
          <div class="card">
              <div class="card-header">
                  <h4>Salvamentos Não Fatais</h4>
              </div>
              <div class="card-body">
                  <h1>{{ $salvamentosNF }}</h1>
              </div>
          </div>
      </div>
  </div>

  <div class="row mt-4">
      <div class="col-sm-4">
          <div class="card">
              <div class="card-header">
                  <h4>Crianças Encontradas</h4>
              </div>
              <div class="card-body">
                  <h1>{{ $criancasEncontradas }}</h1>
              </div>
          </div>
      </div>
      <div class="col-sm-4">
          <div class="card">
              <div class="card-header">
                  <h4>S.O.S Praia & S.O.S Via Publica</h4>
              </div>
              <div class="card-body">
                  <h1>{{ $sos }}</h1>
              </div>
          </div>
      </div>
  </div>

  <hr>
  <a href="{{route('os.cadastro')}}" class="btn btn-primary">Nova Ocorrência</a>
  <a href="{{route('os.consultar')}}" class="btn btn-primary">Ver Dados</a>
    <script>
      $(document).ready(function () {
          $('#form-os').submit(function (event) {
              event.preventDefault();
  
              $.ajax({
                  type: 'POST',
                  url: $(this).attr('action'),
                  data: $(this).serialize(),
                  success: function (response) {
                      $('#os-table tbody').html(response);
                  },
                  error: function (response) {
                      console.log(response);
                  }
              });
          });
      });
  </script>
@endsection




