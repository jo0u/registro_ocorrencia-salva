@extends('layouts.app')
@section('title','Painel de Requerentes')
@section('content')

<center>
<h2>Painel de Controle de Ocorrência</h2>

</center>
<i class="bi bi-plus-circle-dotted"></i>
<i class="bi bi-file-earmark-spreadsheet-fill Smaller"><a href="/os/cadastro">Adicionar O.S</a></i>
<form id="search-form" method="POST">
  @csrf
  <div class="form-group">
      <label for="start_date">Data de início:</label>
      <input type="date" class="form-control" id="start_date" name="start_date" required>
  </div>
  <div class="form-group">
      <label for="end_date">Data de fim:</label>
      <input type="date" class="form-control" id="end_date" name="end_date" required>
  </div>
  <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<!-- Adicione um elemento HTML para exibir os resultados da busca -->
<div id="search-results"></div>
<center>
<div class="card" style="width: 18rem;">
    <!--<img class="card-img-top" src="..." alt="Card image cap">-->
    <div class="card-body">
      <h5 class="card-title">Prevenções</h5>
      <p class="card-text">{{$prevencoes}}</p>
     <!-- <a href="#" class="btn btn-primary">Go somewhere</a>-->
    </div>
  </div>
  <div class="card" style="width: 18rem;">
    <!--<img class="card-img-top" src="..." alt="Card image cap">-->
    <div class="card-body">
      <h5 class="card-title">Salvamento de Afogados Não Fatais</h5>
      <p class="card-text">{{$salvamentosNF}}</p>
     <!-- <a href="#" class="btn btn-primary">Go somewhere</a>-->
    </div>
  </div>

  <div class="card" style="width: 18rem;">
 <!--<img class="card-img-top" src="..." alt="Card image cap">-->
    <div class="card-body">
      <h5 class="card-title">Crianças Encontradas</h5>
      <p class="card-text">{{$criancasEncontradas}}</p>
     <!-- <a href="#" class="btn btn-primary">Go somewhere</a>-->
    </div>
  </div>

  <div class="card" style="width: 18rem;">
    <!--<img class="card-img-top" src="..." alt="Card image cap">-->
       <div class="card-body">
         <h5 class="card-title">S.O.S Praia & S.O.S Via Publica</h5>
         <p class="card-text">{{$sos}}</p>
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a>-->
       </div>
     </div>

     <div class="card" style="width: 18rem;">
        <!--<img class="card-img-top" src="..." alt="Card image cap">-->
           <div class="card-body">
             <h5 class="card-title">Afogamentos Fatais (Óbitos)</h5>
             <p class="card-text">
              
            {{$obitos}}


             </p>
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a>-->
           </div>
         </div>


</center>


!-- Crie um script para enviar a requisição AJAX quando o formulário for submetido -->
<script>
  $(document).ready(function() {
      $('#search-form').submit(function(event) {
          event.preventDefault(); // previne o comportamento padrão do formulário

          // pega os valores dos campos de data
          var startDate = $('#start_date').val();
          var endDate = $('#end_date').val();

          // envia a requisição AJAX
          $.ajax({
              url: '/search', // substitua pela rota correta do seu controlador
              type: 'POST',
              data: {
                  _token: $('input[name="_token"]').val(), // csrf token
                  start_date: startDate,
                  end_date: endDate
              },
              success: function(response) {
                  // atualiza o elemento HTML com os resultados da busca
                  $('#search-results').html(response);
              },
              error: function(xhr) {
                  // trata os erros da requisição
                  console.log(xhr.responseText);
              }
          });
      });
  });
</script>
@endsection