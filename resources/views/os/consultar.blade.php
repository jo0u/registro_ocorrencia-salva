@extends('layouts.app')
@section('title','Painel de Requerentes')
@section('content')
<center>
<h4>Informe a data que você gostaria de buscar pela data de registro do afogamento</h4>
</center>
<form action="{{ route('os.consultar') }}" method="GET" id="filtro-form">
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





<div class="container">
    <h2>Consulta de Ocorrências</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Nome Do Salva-Vidas</th>
          <th>Nome Da Vitima</th>
          <th>Data do Afogamento</th>
          <th>Horas</th>
          <th>Tipo de Ocorrência</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody id="ocorrencias-table">
        <!-- Os dados serão inseridos dinamicamente com AJAX -->
        @foreach($os as $ocorrencia)
        <tr>
          <td>{{ $ocorrencia->nome_salva_vidas}}</td>
          <td>{{ $ocorrencia->nome_vitima}}</td>
          <td>{{ 
         \Carbon\Carbon::parse($ocorrencia->data)->format('d/m/Y')}}</td>
          <td>{{$ocorrencia->hora}}</td>
          <td>{{$ocorrencia->topicos->tipo}}</td>

          <td> <a href="/os/edit/{{$ocorrencia->id}}"><button type="button" class="btn btn-warning text-light">EDITAR</button></a> <button class="delete-btn btn-danger" data-id="{{ $ocorrencia->id }}">Excluir</button>
          </a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-modal-label">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirm-delete-modal-label">Tem certeza que deseja excluir?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Esta ação não pode ser desfeita.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    $(document).ready(function() {
      $('.delete-btn').on('click', function() {
        var id = $(this).data('id');
        $('#confirm-delete-modal').modal('show');
        $('#delete-form').attr('action', '/os/delete/' + id);
      });
    });
  </script>
  

@endsection