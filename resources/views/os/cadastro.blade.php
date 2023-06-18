@extends('layouts.app')
@section('content')
<form action="{{route('os.store')}}" method="POST">
    @csrf
<div class="container">
    <form>
      <div class="row">
        <div class="col-md-6">
          <label for="data">Data:</label>
          <input type="date" id="data" name="data" class="form-control" required>
          <span id="data-error" class="text-danger"></span>
        </div>
        <div class="col-md-6">
          <label for="hora">Hora:</label>
          <input type="time" id="hora" name="hora" class="form-control" required>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <label for="posto">Posto:</label>
          <input type="text" id="posto" name="posto" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label for="id_topico">Tipo Do Ocorrido:</label>
          <select id="topicos_id" name="topicos_id" class="form-control">
          @foreach ($topicos as $t)
          <option value="{{$t->id}}">{{$t->tipo}}</option>
          @endforeach
          </select>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-4">
          <label for="nome_salva_vidas">Nome do Salva-Vidas:</label>
          <input type="text" id="nome_salva_vidas" name="nome_salva_vidas" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label for="nome_vitima">Nome da Vítima:</label>
          <input type="text" id="nome_vitima" name="nome_vitima" class="form-control" required>
        </div>
         <div class="col-md-4">
          <label for="grau">Grau</label>
          <input type="text" id="grau" name="grau" class="form-control">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <label for="sexo">Sexo:</label><br>
          <input type="radio" id="masculino" name="sexo" value="1">
          <label for="masculino">Masculino</label>
          <input type="radio" id="feminino" name="sexo" value="0">
          <label for="feminino">Feminino</label>
        </div>
        <div class="col-md-6">
          <label for="idade">Idade:</label>
          <input type="number" id="idade" name="idade" class="form-control" required>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <label for="estado_civil">Estado Civil:</label>
          <select id="estado_civil" name="estado_civil" class="form-control" required>
            <option value="solteiro">Solteiro</option>
            <option value="casado">Casado</option>
            <option value="divorciado">Divorciado</option>
            <option value="viuvo">Viúvo</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="profissao">Profissão:</label>
          <input type="text" id="profissao" name="profissao" class="form-control">
        </div>
      </div>
      
      <div class="form-group">
        <label for="estado">Estado:</label>
        <select class="form-control" id="estado" name="uf" required>
          <option value="">Selecione</option>
        </select>
      </div>
      <div class="form-group">
        <label for="cidade">Cidade:</label>
        <select class="form-control" id="cidade" name="cidade" required>
          <option value="">Selecione</option>
        </select>
      </div>
      
  
  <div class="row">
    <div class="col-md-6">
      <label for="endereco">Endereço:</label>
      <input type="text" id="endereco" name="endereco" class="form-control">
    </div>
    <div class="col-md-6">
      <label for="turista">É Turista?</label><br>
      <input type="radio" id="sim" name="turista" value="1">
      <label for="sim">Sim</label>
      <input type="radio" id="nao" name="turista" value="0">
      <label for="nao">Não</label>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
        <br><br>
        <div class="form-floating">
            <label for="floatingTextarea2">Observações</label>
            <textarea class="form-control" placeholder="Digite Sua Observação" id="observacao" name="observacao" style="height: 100px"></textarea>
           
          </div>

<br><br>
  <div class="row">
   
    </div>
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Enviar</button>


      <a href="{{route('os.index')}}">Voltar</a>
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





  <script >

async function carregarEstados(estadoSelecionado) {
  const response = await fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
  const estados = await response.json();

  const estadoSelect = document.getElementById('estado');
  estados.forEach((estado) => {
    const option = document.createElement('option');
    option.value = estado.sigla;
    option.text = estado.nome;

    if (estado.sigla === estadoSelecionado) {
      option.selected = true;
    }
    estadoSelect.appendChild(option);
  });
}

const estadoSelect = document.getElementById('estado');
estadoSelect.addEventListener('change', carregarCidades);


async function carregarCidades(cidadeSelecionada) {
  const estadoSigla = document.getElementById('estado').value;
  const response = await fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoSigla}/municipios`);
  const cidades = await response.json();

  const cidadeSelect = document.getElementById('cidade');
  cidadeSelect.innerHTML = '<option value="">Selecione</option>';
  cidades.forEach((cidade) => {
    const option = document.createElement('option');
    option.value = cidade.nome;
    option.text = cidade.nome;

    if (cidade.nome === cidadeSelecionada) {
      option.selected = true;
    }

    cidadeSelect.appendChild(option);
  });
}


window.addEventListener('load', carregarEstados);

    
    </script>

@endsection