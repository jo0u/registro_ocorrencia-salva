@extends('layouts.app')
@section('content')

<form action="/os/{{$ocorrencia->id}}" method="POST">
    @csrf
    @method('PUT')
<div class="container">
    <form>
      <div class="row">
        <div class="col-md-6">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" class="form-control" required>
            <span id="data-error" class="text-danger"></span>
        <div class="col-md-6">
          <label for="hora">Hora:</label>
          <input type="time" id="hora" name="hora" class="form-control" value="{{$ocorrencia->hora}}" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="posto">Posto:</label>
          <input type="text" id="posto" name="posto" class="form-control" value="{{$ocorrencia->posto}}" required>
        </div>
        <div class="col-md-6">
          <label for="id_topico">Tipo Do Ocorrido:</label>
          <select id="topicos_id" name="topicos_id" class="form-control">
          @foreach ($topicos as $t)
          <option value="{{$t->id}}" @if($t->id == $ocorrencia->topicos_id) selected @endif>{{$t->tipo}}</option>
          @endforeach
          </select>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-4">
          <label for="nome_salva_vidas">Nome do Salva-Vidas:</label>
          <input type="text" id="nome_salva_vidas" name="nome_salva_vidas" class="form-control" value="{{$ocorrencia->nome_salva_vidas}}" required> 
        </div>
        <div class="col-md-4">
          <label for="nome_vitima">Nome da Vítima:</label>
          <input type="text" id="nome_vitima" name="nome_vitima" class="form-control" value="{{$ocorrencia->nome_vitima}}" required>
        </div>
         <div class="col-md-4">
          <label for="grau">Grau</label>
          <input type="text" id="grau" name="grau" class="form-control" value="{{$ocorrencia->grau}}">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <label for="sexo">Sexo:</label><br>
          <input type="radio" id="masculino" name="sexo" value="1" @if($ocorrencia->sexo == 1) checked @endif>
          <label for="masculino">Masculino</label>
          <input type="radio" id="feminino" name="sexo" value="0" @if($ocorrencia->sexo == 0) checked @endif>
            <label for="feminino">Feminino</label>
        </div>
        <div class="col-md-6">
            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" class="form-control" value="{{$ocorrencia->idade}}" required>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <label for="estado_civil">Estado Civil:</label>
            <input type="text" id="estado_civil" name="estado_civil" class="form-control" value="{{$ocorrencia->estado_civil}}">
          </div>
          <div class="col-md-6">
            <label for="profissao">Profissão:</label>
            <input type="text" id="profissao" name="profissao" class="form-control" value="{{$ocorrencia->profissao}}">
          </div>
        </div>
        
        <div class="form-group">
          <label for="estado">Estado:</label>
          <input type="text" id="estado" name="estado" class="form-control" value="{{$ocorrencia->uf}}" required>
        </div>
        <div class="form-group">
          <label for="cidade">Cidade:</label>
          <input type="text" id="cidade" name="cidade" class="form-control" value="{{$ocorrencia->cidade}}" required>
        </div>
        
    
    <div class="row">
      <div class="col-md-6">
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" class="form-control" value="{{$ocorrencia->endereco}}">
      </div>
      <div class="col-md-6">
        <label for="turista">É Turista?</label><br>
        <input type="radio" id="sim" name="turista" value="1" @if($ocorrencia->turista == 1) checked @endif>
        <label for="sim">Sim</label>
        <input type="radio" id="nao" name="turista" value="0" @if($ocorrencia->turista == 0) checked @endif>
        <label for="nao">Não</label>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <br><br>
          <div class="form-floating">
              <label for="floatingTextarea2">Observações</label>
              <textarea class="form-control" placeholder="Digite Sua Observação" id="observacao" name="observacao" style="height: 100px" >{{$ocorrencia->observacao}}</textarea>
             
            </div>
  
  <br><br>
    <div class="row">
     
      </div>
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="/os">Voltar</a>
  
       
      </div>
  
    </div>









    </form>


    <script>
        const dataInput = document.getElementById('data');
        const dataError = document.getElementById('data-error');
        
        dataInput.addEventListener('change', function(event) {
          const dataSelecionada = new Date(event.target.value);
          const dataAtual = new Date();
        
          if (dataSelecionada > dataAtual) {
            dataError.textContent = 'A data selecionada não pode ser uma data futura.';
            dataInput.value = '';
            dataInput.focus();
          } else {
            dataError.textContent = '';
          }
        });
      
      </script>

    @endsection